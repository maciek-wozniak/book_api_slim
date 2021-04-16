<?php
/**
 *@OA\Schema(
 *  schema="Book",
 *  @OA\Property(
 *     property="title",
 *     type="string",
 *     description="Title of the book",
 *     example="The Little Prince"
 *  ),
 *  @OA\Property(
 *     property="author",
 *     type="string",
 *     description="Author of the book",
 *     example="Antoine de Saint-Exupéry"
 *  ),
 *  @OA\Property(
 *     property="published",
 *     type="string",
 *     pattern="^\d{4}$",
 *     description="Year of first publish",
 *     example="1943"
 *  ),
 *  @OA\Property(
 *     property="isbn",
 *     type="string",
 *     description="ISBN of the book",
 *     example="978-3-16-148410-0"
 *  ),
 *  @OA\Property(
 *     property="price",
 *     type="number",
 *     format="double",
 *     description="Price of the book",
 *     example="99.99"
 *  ),
 *  @OA\Property(
 *     property="description",
 *     type="string",
 *     description="Description of the book",
 *     example="The narrator begins with a discussion on the nature of grown-ups and their inability to perceive especially important things."
 *  ),
 *  @OA\Property(
 *     property="image_url",
 *     type="string",
 *     description="Image url path",
 *     example="/uploads/img/cover.jpg"
 *  ),
 *  @OA\Property(
 *     property="status",
 *     type="integer",
 *     minimum=0,
 *     maximum=1,
 *     description="Availability of bookL 1 - available, 0 - unavailable",
 *  ),
 *)
 */