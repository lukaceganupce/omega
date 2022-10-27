<?php

namespace App;

class Response
{

    protected $status;
    protected $headers = [];
    protected $body;

    public function __construct($body = '', $status = 200, $headers = [])
    {
        $this->setBody($body);
        $this->setStatus($status);
        $this->setHeaders($headers);

        return $this;
    }

    public function setStatus($code)
    {
        $this->status = $code;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setHeader($header, $value)
    {
        if (array_key_exists($header, $this->headers)) {
            if (!is_array($this->headers[$header])) {
                $this->headers[$header] = [$this->headers[$header]];
            }
            $this->headers[$header][] = $value;
            return $this;
        }
        $this->headers[$header] = $value;
        return $this;
    }

    public function getHeader($header)
    {
        if (isset($this->headres[$header])) {
            return $this->headres[$header];
        }
        return false;
    }

    public function removeHeader($header, $value = null)
    {
        if (isset($this->headres[$header])) {
            if (is_array($this->headres[$header])) {
                if (in_array($value, $this->headres[$header])) {
                    unset($this->headres[$header][array_search($value, $this->headres[$header])]);
                    return true;
                }
            } else {
                if ($this->headres[$header] == $value) {
                    unset($this->headres[$header]);
                    return true;
                }
            }
        }
        return false;
    }

    public function setHeaders($headers)
    {
        foreach ($headers as $header => $value) {
            $this->setHeader($header, $value);
        }
        return $this;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setBody($body, $append = false)
    {
        if ($append) {
            $this->body .= $body;
        } else {
            $this->body = $body;
        }
        return $this;
    }

    public function sendHeaders()
    {
        http_response_code($this->status);
        foreach ($this->headers as $header => $values) {
            if (is_array($values)) {
                foreach ($values as $value) {
                    header($header . ': ' . $value, false);
                }
            } else {
                header($header . ': ' . $values);
            }
        }
    }

    public function send($body = null)
    {

        if (!is_null($body)) {
            $this->body = $body;
        }

        if (!headers_sent()) {
            $this->sendHeaders();
        }

        echo $this->body;

        exit();
    }

}
