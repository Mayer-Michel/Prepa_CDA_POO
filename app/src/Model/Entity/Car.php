<?php

namespace App\Model\Entity;

use Symplefony\Model\Entity;

class Car extends Entity
{
    protected string $label;
    public function getLabel(): string { return $this->label; }
    public function setLabel( string $label ): self
    {
        $this->label = $label;
        return $this;
    }

    protected string $seats;
    public function getSeats(): int { return $this->seats; }
    public function setSeats( int $seats): self
    {
        $this->seats = $seats;
        return $this;
    }

    protected string $energy;
    public function getEnergy(): int { return $this->energy; }
    public function setEnergy( int $energy): self
    {
        $this->energy = $energy;
        return $this;
    }

    protected string $plate_number;
    public function getPlate_number(): string { return $this->plate_number; }
    public function setPlate_number( string $plate_number): self
    {
        $this->plate_number = $plate_number;
        return $this;
    }

    protected string $price_day;
    public function getPrice_day(): float { return $this->price_day; }
    public function setPrice_day( float $price_day): self
    {
        $this->price_day = $price_day;
        return $this;
    }

    protected string $price_distance;
    public function getPrice_distance(): float { return $this->price_distance; }
    public function setPrice_distance( float $price_distance): self
    {
        $this->price_distance = $price_distance;
        return $this;
    }

    protected string $image;
    public function getImage(): string { return $this->image; }
    public function setImage( string $image): self
    {
        $this->image = $image;
        return $this;
    }

}