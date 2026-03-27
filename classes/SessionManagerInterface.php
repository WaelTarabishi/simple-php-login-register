<?php

interface SessionManagerInterface
{
    public function has(string $key): bool;

    public function get(string $key);

    public function put(string $key, $value): void;

    public function regenerateId(): void;

    public function destroy(): void;
}
