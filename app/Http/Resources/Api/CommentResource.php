<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        switch ($this->status) {
            case config('constants.comments.status.accepted'):
                $status = 'accepted';
                break;

            case config('constants.comments.status.rejected'):
                $status = 'rejected';
                break;

            case config('constants.comments.status.pendding'):
                $status = 'pendding';
                break;

            default:
                $status = '-';
                break;
        }

        if (str_contains(request()->url(), 'users-with-comments')) {
            $result = [
                'text' => $this->text,
                'status' => $status,
                'date' => Carbon::instance($this->updated_at)->format('Y-m-d H:i'),
            ];
            if ($this->adminReplay) {
                $result['admin_replay'] = new CommentResource($this->adminReplay);
            }
        } else {
            $result = [
                'user' => $this->user->full_name,
                'user_id' => $this->user->id,
                'text' => $this->text,
                'status' => $status,
                'date' => Carbon::instance($this->updated_at)->format('Y-m-d H:i'),
                'id' => $this->id
            ];
        }
        return $result;
    }
}
