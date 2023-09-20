<?php 
namespace App\Http\Controllers\FormProcessor;

class CMS1500FormProcessor
{
   /**
     * Function: manipulateDates()
     * Purpose: Manipulate the dates in the CMS1500 form data and create a new combined data array.
     * Param: array $data - The input data representing the CMS 1500 form.
     * Return: array - The modified data array with processed date fields.
     */
    public static function manipulateDates(array $data)
    {
        $output = [];
        self::cms1500_date_manipulate($data, $output);
        return $output;
    }

    /**
     * Function: manipulateAddresses()
     * Purpose: Manipulate the address fields in the CMS1500 form data and create a new combined data array.
     * Param: array $data - The input data representing the CMS 1500 form.
     * Return: array - The modified data array with processed address fields.
     */

    public static function manipulateAddresses(array $data)
    {
        return self::cms1500_address_manipulate($data);
    }

     /**
     * Function: cms1500_date_manipulate()
     * Purpose: Helper function to manipulate dates in the CMS1500 form data.
     * Param: array $data - The input data representing the CMS 1500 form.
     *        array &$output - A reference to an array where the modified data will be stored.
     * Return: void (The function modifies the $output array directly.)
     */
    private static function cms1500_date_manipulate($data, &$output)
    {
        // Initialize variables to store the date components (month, day, year)
        $month = $day = $year = "";

        // Loop through the elements of the input data array
        foreach ($data as $entry) {
            // Check if the current element is an array with two elements representing a date entry
            if (is_array($entry) && count($entry) === 2) {
                // Extract "Key_Text" and "Value_Text" from the date entry
                $key_text = $entry[0]["Key_Text"];
                $value_text = $entry[1]["Value_Text"];

                // Attempt to extract month, day, and year from "Key_Text"
                if (strpos($key_text, "MONTH") !== false) {
                    $month = $value_text;
                } elseif (strpos($key_text, "DAY") !== false) {
                    $day = $value_text;
                } elseif (strpos($key_text, "YEAR") !== false) {
                    $year = $value_text;
                } else {
                    // If the date entry doesn't have all date components, add it to the output as is
                    $output[] = [
                        "Key_Text" => $key_text,
                        "Value_Text" => $value_text
                    ];
                }

                // If all date components are found, create a new date entry in the output array
                if ($month && $day && $year) {
                    $output[] = [
                        "Key_Text" => str_replace([" - MONTH", " - DAY", " - YEAR"], "", $key_text) . " - DATE",
                        "Value_Text" => "$month-$day-$year"
                    ];
                    // Reset the variables for the next date entry
                    $month = $day = $year = "";
                }

            } elseif (is_array($entry)) {
                // If the current element is an array (nested array), recursively call the function
                // to process the nested data and add it to the output array.
                self::cms1500_date_manipulate($entry, $output);
            }
        }
    }

   /**
     * Function: cms1500_address_manipulate()
     * Purpose: Helper function to manipulate addresses in the CMS1500 form data.
     * Param: array $data - The input data representing the CMS 1500 form.
     * Return: array - The modified data array with processed address fields.
     */
    private static function cms1500_address_manipulate($data)
    {
       // Initialize an array to store the processed data
       $output = [];

       // Define the field names for service facility location and billing provider information
       $addressFields = [
           "SERVICE FACILITY LOCATION NAME",
           "SERVICE FACILITY LOCATION ADDRESS1",
           "SERVICE FACILITY LOCATION CITY",
           "SERVICE FACILITY LOCATION STATE",
           "SERVICE FACILITY LOCATION ZIP CODE"
       ];
       $billingFields = [
           "BILLING PROVIDER NAME",
           "BILLING PROVIDER ADDRESS1",
           "BILLING PROVIDER CITY",
           "BILLING PROVIDER STATE",
           "BILLING PROVIDER ZIP CODE"
       ];

       // Iterate through each entry in the input data
       foreach ($data as $entry) {
           $key_text = $entry["Key_Text"];
           $value_text = $entry["Value_Text"];

           // Check if the entry contains service facility location information
           if (strpos($key_text, "SERVICE FACILITY LOCATION INFORMATION") !== false) {
               // Process Service Facility Location Information
               $addressParts = explode(" ", $value_text);
               $serviceFacilityAddress = [
                   "SERVICE FACILITY LOCATION NAME" => implode(" ", array_slice($addressParts, 0, -6)),
                   "SERVICE FACILITY LOCATION ADDRESS1" => implode(" ", array_slice($addressParts, -5, 2)),
                   "SERVICE FACILITY LOCATION CITY" => implode(" ", array_slice($addressParts, -3, 1)),
                   "SERVICE FACILITY LOCATION STATE" => implode(" ", array_slice($addressParts, -2, 1)),
                   "SERVICE FACILITY LOCATION ZIP CODE" => implode(" ", array_slice($addressParts, -1)),
               ];

               // Add the processed service facility location fields to the output array
               foreach ($addressFields as $field) {
                   $output[] = [
                       "Key_Text" => "32. " . $field,
                       "Value_Text" => $serviceFacilityAddress[$field] ?? "VALUE_NOT_FOUND"
                   ];
               }
           } elseif (strpos($key_text, "BILLING PROVIDER INFO & PH #") !== false) {
               // Process Billing Provider Info
               $addressParts = explode(" ", $value_text);
               $billingProviderInfo = [
                   "BILLING PROVIDER NAME" => implode(" ", array_slice($addressParts, 0, -6)),
                   "BILLING PROVIDER ADDRESS1" => implode(" ", array_slice($addressParts, -6, 2)),
                   "BILLING PROVIDER CITY" => implode(" ", array_slice($addressParts, -3, 1)),
                   "BILLING PROVIDER STATE" => implode(" ", array_slice($addressParts,-2,1)),
                   "BILLING PROVIDER ZIP CODE" =>  end($addressParts)
               ];

               // Add the processed billing provider fields to the output array
               foreach ($billingFields as $field) {
                   $output[] = [
                       "Key_Text" => "33. " . $field,
                       "Value_Text" => $billingProviderInfo[$field] ?? "VALUE_NOT_FOUND"
                   ];
               }
           } else {
               // For other entries, keep them unchanged and add to the output array
               $output[] = [
                   "Key_Text" => $key_text,
                   "Value_Text" => $value_text
               ];
           }
       }

       // Return the modified data array with processed address fields
       return $output;
    }
}

