<?php

namespace App\Models\Interfaces;

use App\Models\User;
use DateTime;

interface ProfileInterface
{
    public function user(): User;
    public function getId(): int;
    public function type(): string;
    public function getUpdateAt(): DateTime;
    public function getCreatedAt(): DateTime;
}
