<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    const CAL_URL = "https://www.google.com/calendar/render?";
    const CAL_KEY_ACTION = "action=TEMPLATE";
    const CAL_KEY_TEXT = "&text=";
    const CAL_KEY_DATES = "&dates=";
    const CAL_KEY_LOCATION = "&location=Courtenay Gardens Primary School";
    const CAL_KEY_DETAILS = "&details=";
    const DATETIME_FORMAT = "Ymd\THis\Z";
    
    protected $fillable = [
        "name", "date", "start_time", "end_time", "notes"
    ];

    public function getGoogleLink()
    {
        $start_time = ($this->start_time === "" ? "00:00:00" : $this->start_time);
        $end_time = ($this->end_time === "" ? "23:59:59" : $this->end_time);
        $start = new Carbon($this->date . " " . $start_time);
        $end = new Carbon($this->date . " " . $end_time);

        $link = self::CAL_URL;
        $link .= self::CAL_KEY_ACTION;
        $link .= self::CAL_KEY_TEXT . $this->name ;
        $link .= self::CAL_KEY_DATES . $start->format(self::DATETIME_FORMAT) .
                "/" . $end->format(self::DATETIME_FORMAT);
        $link .= self::CAL_KEY_LOCATION;
        $link .= self::CAL_KEY_DETAILS . $this->notes;

        return $link;
    }

    public function getDay()
    {
        $carbon = new Carbon($this->date);
        
        return $carbon->format("l");
    }
}
