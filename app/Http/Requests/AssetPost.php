<?php

namespace App\Http\Requests;

use Auth;
use App\Asset;
use Illuminate\Foundation\Http\FormRequest;

class AssetPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "assets" => "required",
            "type" => "required"
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function($validator) {
            foreach ($this->assets as $asset)
            {
                $formats = null;
                $valid = false;
                $mimeType = $asset->getMimeType();

                switch ($this->type)
                {
                    case Asset::TYPE_IMAGE:
                        $formats = Asset::TYPE_IMAGE_FORMATS;
                        break;
                    case Asset::TYPE_VIDEO:
                        $formats = Asset::TYPE_VIDEO_FORMATS;
                        break;
                    case Asset::TYPE_NEWSLETTER:
                    case Asset::TYPE_PDF:
                        $formats = Asset::TYPE_PDF_FORMATS;
                    default:
                        break;
                }

                foreach ($formats as $format)
                {
                    if ($format === $mimeType)
                    {
                        $valid = true;
                        break;
                    }
                }

                if (!$valid)
                {
                    $validator->errors()->add("assets.*", $asset->getClientOriginalName() . "'s format is not accepted for this type. You selected: " . $this->type . ", and you uploaded: " . $mimeType);
                }
            }
        });
    }
}
