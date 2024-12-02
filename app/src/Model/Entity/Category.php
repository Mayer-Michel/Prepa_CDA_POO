<?php 

namespace App\Model\Entity;

use Symplefony\Model\Entity;

class Category extends Entity
{
    protected string $label;
    public function getLabel(): string { return $this->label; }
    public function setLabel( string $label ): self
    {
        $this->label = $label;
        return $this;
    }
}