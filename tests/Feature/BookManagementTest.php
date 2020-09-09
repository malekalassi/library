<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_add_to_the_library(){
        $response = $this->post('/book' ,[
            'title'=>'cool book title',
            'author'=>'victor'
        ]);
        $book = Book::first();
        $this->assertCount(1 ,Book::all());
        $response->assertRedirect($book->path());


    }

    /** @test */
    public function a_title_is_required()
    {
        $response = $this->post('/book' ,[
            'title'=>'',
            'author'=>'victor'
        ]);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/book' ,[
            'title'=>'',
            'author'=>''
        ]);
        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function can_be_update_the_book(){
        $this->post('/book' ,[
            'title'=>'Cool title',
            'author'=>'Vector'
        ]);

        $book =Book::first();

        $response = $this->patch($book->path() , [
            'title'=>'new title' ,
            'author' =>'malek'
        ]);

        $this->assertEquals('new title' ,Book::first()->title);
        $this->assertEquals('malek' ,Book::first()->author);
        $response->assertRedirect($book->path());
    }

    /** @test */
    public function a_book_can_be_deleted(){
        $this->withoutExceptionHandling();
        $this->post('/book' ,[
            'title'=>'Cool title',
            'author'=>'Vector'
        ]);
        $book =Book::first();
        $this->assertCount(1 , Book::all());
        $response = $this->delete($book->path());

        $this->assertCount(0 ,Book::all());
        $response->assertRedirect('/book');
    }
}
