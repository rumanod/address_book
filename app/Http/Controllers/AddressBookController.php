<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Emails;
use App\Models\PhoneNo;
use App\Models\Addresses;
use App\Models\Groups;
use App\Models\AddressBook;

class AddressBookController extends Controller
{

    //Creates a new person in the address book, does not check for duplicates.
    public function createPerson(Request $request) {
        
        $person = new People;
        $person->firstname = $request->firstname;
        $person->lastname = $request->lastname;
        $person->save();

        if (!empty($request->emails)) {
            foreach($request->emails as $useremail) {
                $email = new Emails;
                $email->people_id = $person->id;
                $email->email = $useremail;
                $email->save();
            } 
        }

        if (!empty($request->phonenos)) {
            foreach($request->phonenos as $userphoneno) {
                $phoneno = new PhoneNo;
                $phoneno->people_id = $person->id;
                $phoneno->number = $userphoneno;
                $phoneno->save();
            } 
        }

        if (!empty($request->addresses)) {
            foreach($request->addresses as $useraddresses) {
                $address = new Addresses;
                $address->people_id = $person->id;
                $address->address = $useraddresses;
                $address->save();
            }
        }

        if (!empty ($request->groupname)) {
            $group = Groups::where("name", $request->groupname)->first();

            if (empty($group)) {
                $group = new Groups;
                $group->name = $request->groupname;
                $group->save();

                $id = $group->id;
            }

            $id = $group->id;
        }

        $addressbook = new AddressBook;
        $addressbook->people_id = $person->id;

        if (!empty($id))
            $addressbook->group_id = $id;

        $addressbook->save();         

        return response()->json([
            "message" => "person record created",
            "data" => $person
        ], 201);
    }

    //Creates a new group, does not check for duplicates
    public function createGroup(Request $request) {
        
        if (empty($request->name)) {
            return response()->json([
                "message" => "group name cannot be empty"
            ], 202);
        }

        $group = new Groups;
        $group->name = $request->name;
        $group->save();     

        return response()->json([
            "message" => "group record created"
        ], 201);
    }

    //Gets person by firstname, lastname or a combination of fname and lname
    public function getPerson($name) {
        return People::where("firstname", "LIKE", "%" . $name . "%")->orwhere("lastname", "LIKE", "%" . $name . "%")->get();
    }

    //Gets person by email address
    public function getPersonEmail($email) {

        $userids = Emails::where("email", "LIKE", "%" . $email . "%")->pluck('people_id');

        if (!empty($userids)) {
            return People::whereIn('id', $userids)->get();
        }

        return response()->json([
            "message" => "No Person Found"
        ], 200);
    }


    // Gets all the people in a group by group name
    public function getPeopleGroup($groupname) {

        $groupid = Groups::where("name", "LIKE", "%" . $groupname . "%")->first();

        if (!empty($groupid)) {
            $userids = AddressBook::whereIn('group_id', $groupid)->pluck('id');
            return People::whereIn('id', $userids)->pluck('id');
        }

        return response()->json([
            "message" => "No Person Found"
        ], 200);
    }

    //Gets all the groups a person belongs to
    public function getGroupsPerson($userid) {

        if (!empty($userid)) {

            $groupids = AddressBook::where([['people_id', $userid], ['group_id', '>', 0]])->pluck('group_id');

            if (!empty($groupids)) {
                return Groups::whereIn('id', $groupids)->pluck('id');
            }
        }

        return response()->json([
            "message" => "No Person Found"
        ], 200);
    }

    public function getAllPeople() {
      // logic to get all students goes here
    }


    public function updatePerson(Request $request, $id) {
      // logic to update a student record goes here
    }

    public function deletePerson($id) {
      // logic to delete a student record goes here
    }    
}
