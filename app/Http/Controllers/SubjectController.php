<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Subject;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            // $filterable = ['is_plural', 'begins_with_article_a', 'begins_with_article_an', 'begins_with_article_the', 'is_people', 'is_animal', 'is_place', 'is_thing'];

            // $subjects = Subject::query();

            // foreach ($filterable as $field) {
            //     $subjects->when($request->$field, fn ($query, $value) => $query->where($field, $value));
            // }

           return Inertia::render('Subject/EditList', [
                'subjects' => Subject::get(),

                // 'subjects' => $subjects,
                // 'filters' => $request->all($filterable)
            ]);

        } catch (\Exception $e) {
            Log::error('Error in SubjectController@index: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Store a new subject resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {
        try {
            $subject = $request->validated();

            $subjectInstance = Subject::create($subject);
            $subjectInstance->levels()->attach(['subject_id' => $subjectInstance->id, 'level_id' => $request->levelId]);
    
            return Redirect::route('Dashboard')->with('success', 'Subject created successfully');
            
        } catch (\Exception $e) {
            Log::error('Error in SubjectController@create: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        try {
            $subject->update($request->validated());
    
            return Redirect::route('Dashboard')->with('success', 'Subject updated successfully');
            
        } catch (\Exception $e) {
            Log::error('Error in SubjectController@update: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
    
            return Redirect::route('Dashboard')->with('success', 'Subject deleted successfully');
            
        } catch (\Exception $e) {
            Log::error('Error in SubjectController@destroy: ' . $e->getMessage());
            throw $e;
        }
    }
}
