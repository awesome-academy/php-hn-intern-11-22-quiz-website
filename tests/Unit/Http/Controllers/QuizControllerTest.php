<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\QuizController;
use App\Http\Requests\QuizStoreRequest;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Category;
use App\Repositories\Quiz\QuizRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Mockery;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;

class QuizControllerTest extends TestCase
{
    use WithFaker;
    protected $quizMock;
    protected $categoryMock;
    protected $quizController;
    protected $quiz;
    protected $quizzes;
    protected $user;
    protected $categories;

    public function setUp(): void
    {
        parent::setUp();
        $this->quiz = Quiz::factory()->make();
        $this->quizzes = Quiz::factory()->count(5)->make();
        $this->categories = Category::factory()->count(5)->make();
        $this->quiz->id = rand(1, 100);
        $this->user = User::factory()->make();
        $this->quizMock = Mockery::mock(QuizRepositoryInterface::class);
        $this->categoryMock = Mockery::mock(CategoryRepositoryInterface::class);

        $this->quizController = new QuizController(
            $this->quizMock,
            $this->categoryMock,
        );
    }

    public function testIndex()
    {
        $this->quizMock->shouldReceive('getAll')->andReturn($this->quizzes);
        $result = $this->quizController->index();
        $data = $result->getData();
        $this->assertEquals($this->quizzes, $data['quizzes']);
        $this->assertIsArray($data);
        $this->assertEquals('quizzes.index', $result->getName());
        $this->assertArrayHasKey('quizzes', $data);
    }

    public function testCreate()
    {
        $this->categoryMock->shouldReceive('getAll')->andReturn($this->categories);
        $result = $this->quizController->create();
        $data = $result->getData();
        $this->assertEquals($this->categories, $data['categories']);
        $this->assertIsArray($data);
        $this->assertEquals('quizzes.create', $result->getName());
        $this->assertArrayHasKey('categories', $data);
    }

    public function testShow()
    {
        $this->quizMock->shouldReceive('find');
        $result = $this->quizController->show($this->quiz->id);
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('quizzes.show', $result->getName());
        $this->assertArrayHasKey('quiz', $data);
    }

    public function testEdit()
    {
        $this->quizMock->shouldReceive('find');
        $result = $this->quizController->edit($this->quiz->id);
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertEquals('quizzes.edit', $result->getName());
        $this->assertArrayHasKey('quiz', $data);
    }

    public function testStore()
    {
        $attr = new QuizStoreRequest();
        $attr->title = $this->quiz->title;
        $attr->description = $this->quiz->description;
        $attr->category_id = $this->quiz->category_id;
        $this->quizMock->shouldReceive('create')->andReturn($this->quiz);
        $this->be($this->user);
        $result = $this->quizController->store($attr);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('quizzes.show', $this->quiz->id), $result->getTargetUrl());
    }

    public function testUpdate()
    {
        $attr = new QuizStoreRequest();
        $attr->title = $this->quiz->title;
        $attr->description = $this->quiz->description;
        $attr->category_id = $this->quiz->category_id;
        $this->quizMock->shouldReceive('update')->andReturn($this->quiz);
        $result = $this->quizController->update($attr, $this->quiz->id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('quizzes.index'), $result->getTargetUrl());
    }

    public function testDestroy()
    {
        $this->quizMock->shouldReceive('deleteQuiz')->andReturn(true);
        $result = $this->quizController->destroy($this->quiz->id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
    }

    public function testSearch()
    {
        $attr = new Request();
        $attr->search = rand(1, 100);
        $this->quizMock->shouldReceive('getQuiz')->andReturn($this->quiz);
        $result = $this->quizController->searchQuiz($attr);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('quizzes.show', $this->quiz->id), $result->getTargetUrl());
    }

    public function testSearchFail()
    {
        $attr = new Request();
        $attr->search = -5000;
        $this->quizMock->shouldReceive('getQuiz')->andReturn(null);
        $result = $this->quizController->searchQuiz($attr);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertArrayHasKey('alert', session()->all());
    }

    public function testSearchNothing()
    {
        $attr = new Request();
        $result = $this->quizController->searchQuiz($attr);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertArrayHasKey('alert', session()->all());
    }

    public function tearDown(): void
    {
        unset($this->quizMock);
        unset($this->categoryMock);
        unset($this->quizController);
        unset($this->user);
        unset($this->categories);
        unset($this->quizzes);
        unset($this->quiz);
        Mockery::close();
        parent::tearDown();
    }
}
