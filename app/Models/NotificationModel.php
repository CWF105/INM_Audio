<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type', 'message', 'extra_info', 'is_read', 'created_at'];

    public function getUnreadCount()
    {
        return $this->where('is_read', 0)->countAllResults();
    }

    public function getNotifications()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }

    public function markAsRead($id)
    {
        return $this->update($id, ['is_read' => 1]);
    }

    public function deleteNotification($id)
    {
        return $this->delete($id);
    }
}
