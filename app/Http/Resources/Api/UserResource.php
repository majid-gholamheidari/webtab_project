<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        switch ($this->gender) {
            case config('constants.users.gender.male'):
                $gender = 'Male';
                break;

            case config('constants.users.gender.female'):
                $gender = 'Female';
                break;

            default:
                $gender = '-';
                break;
        }
        $result = [
            'image' => $this->image_path,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'gender' => $gender,
            'email' => $this->email,
            'phonenumber' => $this->phonenumber,
            'country_code' => $this->national_code,
            'id' => $this->id
        ];
        if ($this->user_comments) {
            $result = [
                'image' => url('/public' . $this->image_path),
                'name' => $this->name,
                'lastname' => $this->lastname,
                'gender' => $gender,
                'email' => $this->email,
                'phonenumber' => $this->phonenumber,
                'country_code' => $this->national_code,
                'comments' => CommentResource::collection($this->user_comments)
            ];
        }
        return $result;
    }
}
