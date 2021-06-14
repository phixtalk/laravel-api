<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="Update User Info Request",
 *     description="Update user info request body data",
 * )
 */
class UpdateInfoRequest extends FormRequest
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
            'email' => 'email'
        ];
    }
}
