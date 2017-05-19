<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utility;
use App\Http\Requests;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters =  Utility::scanDirectory();

        return view("admin.newsletter.index")
            ->with("newsletters", $newsletters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.newsletter.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dir = public_path("assets/pdf/test");
        $name = "issue". $request->input('issue') . ".pdf";
        $check = $dir ."/". $name;

        if ($request->file("asset")->isValid()) {
            if (preg_match("/\w*.pdf$/",$request->asset->hashName())) {
                if (file_exists($check)){
                    unlink($check);
                }
                try
                {
                    $request->file("asset")->move($dir, $name);
                }
                catch (FileException $e)
                {
                    return back()->withInput()
                        ->with("errors", "Could not move file: " . $e->getMessage());
                }
            }
            else
            {
                return back()->withInput()
                    ->with("errors", "Not a valid PDF file");
            }

        }
        else
        {
            return back()->withInput()
                ->with("errors", "Not a valid issue");
        }

        return redirect()->route("admin.newsletter.index")
            ->with("success", "newsletter uploaded successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($name)
    {
        $dir = public_path("assets/pdf/test");
        $check = $dir ."/". $name;

        if (file_exists($check)){
            unlink($check);
        }
        else
        {
            echo "delete unsuccessful";
        }

        return redirect()->route("admin.newsletter.index")
            ->with("success", $name." deleted successfully");
    }
}
