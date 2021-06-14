<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="Update User Request",
 *     description="Update user request body data",
 * )
 */
class UserUpdateRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     title="first_name"
     * )
     *
     * @var string
     */
    private $first_name;

    /**
     * @OA\Property(
     *      title="Name"
     * )
     *
     * @var string
     */
    public $last_name;

    /**
     * @OA\Property(
     *      title="email"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *     title="role_id",
     * )
     *
     * @var int
     */
    private $role_id;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}
