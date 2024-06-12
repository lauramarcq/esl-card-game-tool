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
        Inertia::render('Dashboard', [
            'subjects' => Subject::query()
            ->when($request->is_plural, fn ($query) => $query->where('is_plural', $request->is_plural))
            ->when($request->begins_with_article_a, fn ($query) => $query->where('begins_with_article_a', $request->begins_with_article_a))
            ->when($request->begins_with_article_an, fn ($query) => $query->where('begins_with_article_an', $request->begins_with_article_an))
            ->when($request->begins_with_article_the, fn ($query) => $query->where('begins_with_article_the', $request->begins_with_article_the))
            ->when($request->is_people, fn ($query) => $query->where('is_people', $request->is_people))
            ->when($request->is_animal, fn ($query) => $query->where('is_animal', $request->is_animal))
            ->when($request->is_place, fn ($query) => $query->where('is_place', $request->is_place))
            ->when($request->is_thing, fn ($query) => $query->where('is_thing', $request->is_thing)),
            'filters' => $request->all(['is_plural', 'begins_with_article_a', 'begins_with_article_an', 'begins_with_article_the', 'is_people', 'is_animal', 'is_place', 'is_thing'])
        ]);
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
