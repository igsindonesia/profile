<?php

namespace App\Services;

class SEOMeta
{
    protected array $tags = [];

    public function title(string $title): static
    {
        $this->tags['og:title'] = $title;
        $this->tags['twitter:title'] = $title;
        $this->tags['title'] = $title;

        return $this;
    }

    public function description(?string $description): static
    {
        if (is_null($description)) {
            return $this;
        }

        $this->tags['description'] = $description;
        $this->tags['og:description'] = $description;
        $this->tags['twitter:description'] = $description;

        return $this;
    }

    public function image(?string $url): static
    {
        if (is_null($url)) {
            return $this;
        }

        $this->tags['og:image'] = $url;
        $this->tags['twitter:image'] = $url;

        return $this;
    }

    public function url(?string $url): static
    {
        if (is_null($url)) {
            return $this;
        }

        $this->tags['og:url'] = $url;

        return $this;
    }

    public function type(string $type): static
    {
        $this->tags['og:type'] = $type;

        return $this;
    }

    public function card(string $type = 'summary_large_image'): static
    {
        $this->tags['twitter:card'] = $type;

        return $this;
    }

    public function set(string $key, ?string $value): static
    {
        if (is_null($value)) {
            return $this;
        }

        $this->tags[$key] = $value;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }
}
