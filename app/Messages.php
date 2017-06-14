<?php

namespace App;

/**
 * This class stores all of the messages for each model.
 * Usage examples 
 * (after updating a link):
 *     return redirect()->route("admin.links.index")
 *             ->with(Messages::SUCCESS, Messages::LINK[Messages::UPDATED]);
 */
class Messages
{
    const ERRORS = "errors";
    const SUCCESS = "success";
    const CREATED = "created";
    const UPDATED = "updated";
    const DELETED = "deleted";
    const WARNINGS = "warnings";

    const ASSET = [
        self::ERRORS => "Asset is not the selected type!",
        self::CREATED => "Asset uploaded successfully",
        self::UPDATED => "Asset updated successfully",
        self::DELETED => "Asset removed successfully"
    ];

    const BACKUP = [
        self::CREATED => "Backup created successfully",
        self::UPDATED => "Backup updated successfully",
        self::DELETED => "Backup deleted successfully"
    ];

    const CAROUSEL = [
        self::CREATED => "Carousel rewritten successfully",
        self::UPDATED => "Carousel item updated successfully",
        self::DELETED => "Carousel item removed successfully"
    ];

    const EVENT = [
        self::CREATED => "Event created successfully",
        self::UPDATED => "Event updated successfully",
        self::DELETED => "Event deleted successfully"
    ];

    const LINK = [
        self::CREATED => "Link created successfully",
        self::UPDATED => "Link updated successfully",
        self::DELETED => "Link deleted successfully"
    ];

    const PAGE = [
        self::CREATED => "Page created and written successfully",
        self::UPDATED => "Page updated and rewritten successfully",
        self::DELETED => "Page deleted successfully"
    ];

    const CONTACT = [
        self::SUCCESS => "The email has been sent successfully!",
    ];
}