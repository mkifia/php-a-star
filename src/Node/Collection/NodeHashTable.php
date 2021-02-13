<?php

namespace JMGQ\AStar\Node\Collection;

use JMGQ\AStar\Node\Node;

/**
 * @template TNode
 * @implements \IteratorAggregate<array-key, Node<TNode>>
 * @implements NodeCollectionInterface<TNode>
 */
class NodeHashTable implements \IteratorAggregate, NodeCollectionInterface
{
    /** @var Node<TNode>[] */
    private array $nodes = [];

    /**
     * {@inheritdoc}
     * @return \ArrayIterator<array-key, Node<TNode>>
     */
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->nodes);
    }

    /**
     * {@inheritdoc}
     */
    public function extractBest(): ?Node
    {
        $bestNode = null;

        foreach ($this->nodes as $node) {
            if ($bestNode === null || $node->getF() < $bestNode->getF()) {
                $bestNode = $node;
            }
        }

        if ($bestNode !== null) {
            $this->remove($bestNode);
        }

        return $bestNode;
    }

    public function get(string $nodeId): ?Node
    {
        return $this->nodes[$nodeId] ?? null;
    }

    public function add(Node $node): void
    {
        $this->nodes[$node->getId()] = $node;
    }

    public function remove(Node $node): void
    {
        unset($this->nodes[$node->getId()]);
    }

    public function isEmpty(): bool
    {
        return empty($this->nodes);
    }

    public function contains(Node $node): bool
    {
        return isset($this->nodes[$node->getId()]);
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): void
    {
        $this->nodes = [];
    }
}
