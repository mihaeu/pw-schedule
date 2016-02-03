<?php declare(strict_types = 1);

class UserCollection implements Countable, IteratorAggregate
{
    /**
     * @var SplObjectStorage
     */
    private $users;

    public function __construct()
    {
        $this->users = new SplObjectStorage();
    }

    public function add(User $user)
    {
        $this->users->attach($user);
    }

    public function getIterator()
    {
        return $this->users;
    }

    public function count()
    {
        return count($this->users);
    }
}


