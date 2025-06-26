<?php

namespace App\Repositories\Contracts;

interface ShoeRepositoryInterface
{
    public function getPopularShoes($limit);
    public function getAllNewShoes();
    public function find($Id);
    public function getPrice($ticketId);
    public function searchByName(string $keyword);
}