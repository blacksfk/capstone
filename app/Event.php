<?php

namespace App;

use Carbon\Carbon;
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
        "name", "start_date", "end_date", "start_time", "end_time", "notes"
    ];

    /**
     * Creates a link to create a google calendar event.
     * Time needs to be converted to UTC.
     * 
     * @return string A link to create a google calendar event
     */
    public function getGoogleLink()
    {
        $start_time = ($this->start_time === "" ? "00:00:00" : $this->start_time);
        $end_time = ($this->end_time === "" ? "23:59:59" : $this->end_time);
        $start = new Carbon($this->start_date . " " . $start_time, "Australia/Melbourne");
        $end = new Carbon($this->end_date . " " . $end_time, "Australia/Melbourne");
        $start->tz = "UTC";
        $end->tz = "UTC";

        $link = self::CAL_URL;
        $link .= self::CAL_KEY_ACTION;
        $link .= self::CAL_KEY_TEXT . $this->name ;
        $link .= self::CAL_KEY_DATES . $start->format(self::DATETIME_FORMAT) .
                "/" . $end->format(self::DATETIME_FORMAT);
        $link .= self::CAL_KEY_LOCATION;
        $link .= self::CAL_KEY_DETAILS . $this->notes;

        return $link;
    }

    /**
     * Get the start day of the event from the date
     *
     * @return string The day of the event start
     */
    public function getStartDay()
    {
        $carbon = new Carbon($this->start_date);
        
        return $carbon->format("l");
    }

    /**
     * Get the end day of the event from the date
     *
     * @return string The day of the event end
     */
    public function getEndDay()
    {
        $carbon = new Carbon($this->end_date);

        return $carbon->format("l");
    }
}
