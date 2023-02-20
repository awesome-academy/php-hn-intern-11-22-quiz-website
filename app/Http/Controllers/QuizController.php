<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuizStoreRequest;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Notification\NotificationRepositoryInterface;
use Pusher\Pusher;

class QuizController extends Controller
{
    /**
     * @var QuizRepositoryInterface
     */
    protected $quizRepo;
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepo;
    /**
     * @var NotificationRepositoryInterface
     */
    protected $notificationRepo;
    

    public function __construct(
        QuizRepositoryInterface $quizRepo,
        CategoryRepositoryInterface $categoryRepo,
        NotificationRepositoryInterface $notificationRepo
    ) {
        $this->quizRepo = $quizRepo;
        $this->categoryRepo = $categoryRepo;
        $this->notificationRepo = $notificationRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = $this->quizRepo->getAll();
        
        return view('quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepo->getAll();

        return view('quizzes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuizStoreRequest $request)
    {
        $request['user_id'] = auth()->user()->id;
        $quiz = $this->quizRepo->create($request->all());

        return redirect()->route('quizzes.show', $quiz->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = $this->quizRepo->find($id);

        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = $this->quizRepo->find($id);

        return view('quizzes.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuizStoreRequest $request, $id)
    {
        $quiz = $this->quizRepo->update($id, $request->all());
        $this->notificationRepo->notify($quiz->user, 'updated');
        
        return redirect()->route('quizzes.index');
    }

    public function readNotification($id)
    {
        try {
            auth()->user()->Notifications->find($id)->markAsRead();
        } catch (\Exception $e) {
            return response()->json([
                'mess' => $e,
            ], 404);
        }

        return response()->json([
            'mess' => 'success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = $this->quizRepo->find($id);
        $this->notificationRepo->notify($quiz->user, 'deleted');
        $this->quizRepo->deleteQuiz($id);
    
        return redirect()->back();
    }

    /**
     * Search for quiz
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchQuiz(Request $request)
    {
        if ($request->search) {
            $quiz = $this->quizRepo->getQuiz($request->search);
            if ($quiz) {
                return redirect()->route('quizzes.show', $quiz->id);
            }
            return redirect()->back()->with('alert', 'No such quiz exist!');
        } else {
            return redirect()->back()->with('alert', 'Enter something for the entrycode!');
        }
    }
}
