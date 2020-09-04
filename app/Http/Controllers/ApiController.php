<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

class ApiController extends Controller
{
    public function getAllStudents(){
        $students = Student::get()->toJson(JSON_PRETTY_PRINT); //JSON_PRETTY_PRINT serialises the JSON
        return response($students, 200);
    }

    public function createStudent(Request $request){
        if($request->name != "" && $request->course != ""){
            $student = new Student;
            $student->name = $request->name;
            $student->course = $request->course;
            $student->save();
            return response()->json([
                "message" => "Record created",
                "statusCode" => "201"
            ], 201); //201 - SUCCESS, CREATED
        } else {
            return response()->json([
               
                "message" => "Record not created",
                "statusCode" => "400"
            ], 400); //400 BAD REQUEST
        }

        
    }

    public function getStudent($id) {
        if(Student::where('id', $id)->exists()) {
            $student = Student::where('id',$id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
        } else {
            return response()->json([
                "message" => "Student not found",
                "statusCode" => "404"
            ], 404);
        }
    }

    public function updateStudent(Request $request, $id) {
        if (Student::where('id',$id)->exists()) {
            $student = Student::find($id);
            $student->name = is_null($request->name) ? $student->name : $request->name;
            $student->course = is_null($request->course) ? $student->course : $request->course; //if the request has an empty field, just use the one that is already in use.
            $student->save();

            return response()->json([
                "message" => "Record updated successfully",
                "requestName" => "$request->name",
                "requestCourse" => "$request->course",
            ], 200);
        } else {
            return response()->json([
                "message" => "Student not found"
            ], 404);
        }
    }

    public function deleteStudent ($id) {
        if(Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);//202 Accepted
        } else {
            return response()->json([
                "message" =>"Student not found"
            ], 404);
        }
    }
}
