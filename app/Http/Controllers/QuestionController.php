<?php

namespace App\Http\Controllers;

use App\Helpers\APIHelpers;
use App\Http\Requests\AjoutQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        $response = APIHelpers::createAPIResponse(false, 200, '', $questions);
        return response()->json($response, 200);
    }

    public function store(AjoutQuestionRequest $request)
    {
        $input = $request->all();
        $new_question = Question::create($input);
        $question_save = $new_question->save();
        if($question_save){
            $response = APIHelpers::createAPIResponse(false, 201, 'Ajout avec succés',$new_question);
            return response()->json($response, 200);
        }
        else{
            $response = APIHelpers::createAPIResponse(false, 201, 'Erreur de sauvguarde', null);
            return response()->json($response, 201);
        }
    }

    public function show($id)
    {
        $question = Question::find($id);
        if ($question == null) {
            $response = APIHelpers::createAPIResponse(true, 204, 'question introuvable', null);
        } else {
            $response = APIHelpers::createAPIResponse(false, 200, 'question disponible', $question);
        }
        return response()->json($response, 200);
    }

    public function update(UpdateQuestionRequest $request,$id){
        $question= Question::find($id);
        if($question!=null){
        {
            if($request->has('type')) {
            $question->type = $request->type;
            }
            if($request->has('question')) {
            $question->question = $request->question;
            }
            $question_save = $question->save();
            if ($question_save) {
                $response = APIHelpers::createAPIResponse(false, 201, 'Modifiction avec succes', $question);
                return response()->json($response, 200);
            } 
            else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
        }else{
            $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
            return response()->json($response, 400); 
        }
    }
    
    public function destroy($id)
    {
        $question = Question::find($id);
        if ($question == null) {
            $response = APIHelpers::createAPIResponse(true, 400, 'echec question Introuvable', null);
            return response()->json($response, 400);
        } else {
            $question_delete = $question->delete();
            if ($question_delete) {
                $response = APIHelpers::createAPIResponse(false, 200, 'Suppression avec succes', $question);
                return response()->json($response, 200);
            } else {
                $response = APIHelpers::createAPIResponse(true, 400, 'echec', null);
                return response()->json($response, 400);
            }
        }
    }
}
