<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: authentication.proto

namespace GRPC\authentication;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>authentication.LoginEmailResponse</code>
 */
class LoginEmailResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string token = 1;</code>
     */
    protected $token = '';
    /**
     * Generated from protobuf field <code>repeated string message = 2;</code>
     */
    private $message;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $token
     *     @type array<string>|\Google\Protobuf\Internal\RepeatedField $message
     * }
     */
    public function __construct($data = NULL) {
        \GRPC\authentication\GPBMetadata\Authentication::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string token = 1;</code>
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Generated from protobuf field <code>string token = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->token = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated string message = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Generated from protobuf field <code>repeated string message = 2;</code>
     * @param array<string>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setMessage($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->message = $arr;

        return $this;
    }

}

