<?php

class DateLib {

    // Convert dd-mm-yy in BE format to yy-mm-dd in AD format.
    public function convertBEToAD($date) {
        $newDate = explode("-", $date);
        return (intval($newDate[2])-543)."-".$newDate[1]."-".$newDate[0];
    }

    // Convert yy-mm-dd in AD format to dd-mm-yy in BE format.
    public function convertADToBE($date) {
        $newDate = explode("-", $date);
        return ($newDate[2])."-".($newDate[1])."-".(intval($newDate[0])+543);
    }
}
