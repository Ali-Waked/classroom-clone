<?php

namespace App\Services;

use App\Models\Classroom;
use App\Models\Topic;

class TopicService
{
    /**
     * Create New Classroom Topic
     *
     * @param Classroom $classroom
     * @param array $data
     * @return Topic
     */
    public function createTopic(Classroom $classroom, array $data): Topic
    {
        return $classroom->topics()->create($data);
    }

    /**
     * Update Classroom Topic
     *
     * @param Topic $topic
     * @param array $data
     * @return boolean
     */
    public function updateTopic(Topic $topic, array $data): bool
    {
        return $topic->update($data);
    }

    /**
     * Delete Classroom Topic
     *
     * @param Topic $topic
     * @return boolean
     */
    public function deleteTopic(Topic $topic): bool
    {
        return $topic->delete();
    }
}
