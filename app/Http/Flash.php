<?php

namespace App\Http;

use Illuminate\Support\Facades\Session;

class Flash
{
    /**
     * The flash message key.
     *
     * @var string
     */
    protected $key = 'flash_messages';

    /**
     * Reprecent the last flash message index.
     *
     * @var int
     */
    protected $placeholder = [];

    /**
     * Auto generate our flash message once the class is destoryed.
     */
    public function __destruct()
    {
        $this->buildPlaceholderMessage();
    }

    /**
     * Build and saves our flash message to our session once it
     * is completeply built.
     */
    protected function buildPlaceholderMessage()
    {
        if (! empty($this->placeholder)) {
            Session::push($this->getCurrentKey(), $this->placeholder);
            $this->placeholder = [];
        }
    }

    /**
     * Create a flash message.
     *
     * @param string      $title
     * @param string      $message
     * @param string      $level
     * @param string|null $key
     *
     * @return Flash $this
     */
    protected function create($title, $message, $level)
    {
        $this->placeholder = [
            'level' => $level,
            'title' => $title,
            'message' => $message,
        ];

        return $this;
    }

    /**
     * Create an success flash message.
     *
     * @param string $title
     * @param string $message
     *
     * @return Flash $this
     */
    public function success($title, $message)
    {
        return $this->create($title, $message, 'success');
    }

    /**
     * Create an information flash message.
     *
     * @param string $title
     * @param string $message
     *
     * @return Flash $this
     */
    public function info($title, $message)
    {
        return $this->create($title, $message, 'info');
    }

    /**
     * Create an warning flash message.
     *
     * @param string $title
     * @param string $message
     *
     * @return Flash $this
     */
    public function warning($title, $message)
    {
        return $this->create($title, $message, 'warning');
    }

    /**
     * Create an error flash message.
     *
     * @param string $title
     * @param string $message
     *
     * @return Flash $this
     */
    public function error($title, $message)
    {
        return $this->create($title, $message, 'danger');
    }

    /**
     * Checks to see if we have any flash messages.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return ! Session::has($this->getCurrentKey());
    }

    /**
     * Returns all of our flash messages and resets the session array.
     *
     * @return array $messages
     */
    public function all()
    {
        $messages = Session::get($this->getCurrentKey(), []);

        Session::put($this->getCurrentKey(), []);

        return $messages;
    }

    /**
     * Get the current key, and increment the latest messages index by one.
     *
     * @return string $key
     */
    protected function getCurrentKey()
    {
        return $this->key;
    }
}
