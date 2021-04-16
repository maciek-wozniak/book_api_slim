<?php

use App\Config\Db;
use Slim\Http\Response as Response;
use Slim\Http\ServerRequest as Request;

/** @var $app \Slim\App */


/**
 * @OA\Info(title="Book API", version="0.1")
 */


$app->redirect('/', '/books', 302);

/**
 * @OA\Get(
 *     path="/books",
 *     summary="Get list of all books",
 *     @OA\Response(response="200", description="List of all books", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))),
 *     @OA\Response(response="500", description="Server error occured")
 * )
 */
$app->get('/books', function (Request $request, Response $response, $args) {
    try {
        $books = Db::getInstance()->query("SELECT * FROM book")->fetchAll(PDO::FETCH_OBJ);
    }
    catch (PDOException $e) {
        return $response->withJson($e->getMessage(), 500);
    }

    return $response->withJson($books);
});



/**
 * @OA\Get(
 *     path="/book/{id}",
 *     summary="Get book information",
 *     @OA\Response(response="200", description="Book with given ID", @OA\JsonContent(ref="#/components/schemas/Book")),
 *     @OA\Response(response="404", description="Book not found"),
 *     @OA\Response(response="500", description="Server error occured")
 * )
 */
$app->get('/book/{id}', function (Request $request, Response $response, $args) {
    $book = null;
    try {
        $sql = Db::getInstance()->prepare("SELECT * FROM book WHERE id=:id");
        $sql->bindParam(":id", $args['id'], PDO::PARAM_INT);
        $sql->execute();
        $book = $sql->fetch(PDO::FETCH_OBJ);
    }
    catch (PDOException $e) {
        return $response->withJson($e->getMessage(), 500);
    }

    if (!$book) {
        return $response->withJson('Book not found', 404);
    }
    $book->price = $book->price/100;
    return $response->withJson($book);;
});



/**
 * @OA\Post(
 *     path="/books",
 *     summary="Add new book",
 *     @OA\RequestBody(request="/book", description= "Provide new book data", required=true, @OA\JsonContent(ref="#/components/schemas/Book")),
 *     @OA\Response(response="200", description="Book was successful added"),
 *     @OA\Response(response="500", description="Server error occured")
 * )
 */
$app->post('/books', function (Request $request, Response $response, $args) {
    $title = $request->getParam('title');
    $author = $request->getParam('author');
    $published = $request->getParam('published');
    $isbn = $request->getParam('isbn');
    $price = $request->getParam('price') * 100;
    $description = $request->getParam('description');
    $status = $request->getParam('status');
    $image_url = $request->getParam('image_url');
    $created_at = (new DateTime())->format('Y-m-d H:i:s');

    try {
        $sql = Db::getInstance()
            ->prepare("INSERT INTO book (author, title, published, isbn, price, description, status, image_url, created_at) values 
                (:author, :title, :published, :isbn, :price, :description, :status, :image_url, :created_at)");
        $sql->bindParam(":author", $author);
        $sql->bindParam(":title", $title);
        $sql->bindParam(":published", $published);
        $sql->bindParam(":isbn", $isbn);
        $sql->bindParam(":price", $price);
        $sql->bindParam(":description", $description);
        $sql->bindParam(":status", $status);
        $sql->bindParam(":image_url", $image_url);
        $sql->bindParam(":created_at", $created_at);
        $sql->execute();
    }
    catch (PDOException $e) {
        return $response->withJson($e->getMessage(), 500);
    }

    return $response->withJson('Book added!', 200);
});