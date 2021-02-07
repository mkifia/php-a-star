<?php

namespace JMGQ\AStar;

interface NodeCollectionInterface extends \Traversable
{
    /**
     * Obtains the node with the lowest F score. It also removes it from the collection.
     *
     * @return Node|null
     */
    public function extractBest(): ?Node;

    public function get(Node $node): ?Node;

    public function add(Node $node): void;

    public function remove(Node $node): void;

    public function isEmpty(): bool;

    public function contains(Node $node): bool;

    /**
     * Empties the collection
     */
    public function clear(): void;
}