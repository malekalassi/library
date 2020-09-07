<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_book_can_be_add_to_the_library(){
        $this->withoutExceptionHandling();
        $response = $this->post('/book' ,[
            'title'=>'cool book title',
            'author'=>'victor'
        ]);
        $response->assertOk();
        $this->assertCount(1 ,Book::all());


    }

    /** @test */
    public function a_title_is_required()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post('/book' ,[
            'title'=>'',
            'author'=>'victor'
        ]);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_author_is_required()
    {
//        $this->withoutExceptionHandling();
        $response = $this->post('/book' ,[
            'title'=>'',
            'author'=>''
        ]);
        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function can_be_update_the_book(){
        $this->withoutExceptionHandling();
        $this->post('/book' ,[
            'title'=>'Cool title',
            'author'=>'Vector'
        ]);

        $book =Book::first();

        $response = $this->patch('/book/'.$book->id , [
            'title'=>'new title' ,
            'author' =>'malek'
        ]);

        $this->assertEquals('new title' ,Book::first()->title);
        $this->assertEquals('malek' ,Book::first()->author);
    }
}
