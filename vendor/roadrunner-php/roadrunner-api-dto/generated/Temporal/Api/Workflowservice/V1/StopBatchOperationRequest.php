<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# NO CHECKED-IN PROTOBUF GENCODE
# source: temporal/api/workflowservice/v1/request_response.proto

namespace Temporal\Api\Workflowservice\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>temporal.api.workflowservice.v1.StopBatchOperationRequest</code>
 */
class StopBatchOperationRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Namespace that contains the batch operation
     *
     * Generated from protobuf field <code>string namespace = 1;</code>
     */
    protected $namespace = '';
    /**
     * Batch job id
     *
     * Generated from protobuf field <code>string job_id = 2;</code>
     */
    protected $job_id = '';
    /**
     * Reason to stop a batch operation
     *
     * Generated from protobuf field <code>string reason = 3;</code>
     */
    protected $reason = '';
    /**
     * Identity of the operator
     *
     * Generated from protobuf field <code>string identity = 4;</code>
     */
    protected $identity = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $namespace
     *           Namespace that contains the batch operation
     *     @type string $job_id
     *           Batch job id
     *     @type string $reason
     *           Reason to stop a batch operation
     *     @type string $identity
     *           Identity of the operator
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Temporal\Api\Workflowservice\V1\RequestResponse::initOnce();
        parent::__construct($data);
    }

    /**
     * Namespace that contains the batch operation
     *
     * Generated from protobuf field <code>string namespace = 1;</code>
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Namespace that contains the batch operation
     *
     * Generated from protobuf field <code>string namespace = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setNamespace($var)
    {
        GPBUtil::checkString($var, True);
        $this->namespace = $var;

        return $this;
    }

    /**
     * Batch job id
     *
     * Generated from protobuf field <code>string job_id = 2;</code>
     * @return string
     */
    public function getJobId()
    {
        return $this->job_id;
    }

    /**
     * Batch job id
     *
     * Generated from protobuf field <code>string job_id = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setJobId($var)
    {
        GPBUtil::checkString($var, True);
        $this->job_id = $var;

        return $this;
    }

    /**
     * Reason to stop a batch operation
     *
     * Generated from protobuf field <code>string reason = 3;</code>
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Reason to stop a batch operation
     *
     * Generated from protobuf field <code>string reason = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setReason($var)
    {
        GPBUtil::checkString($var, True);
        $this->reason = $var;

        return $this;
    }

    /**
     * Identity of the operator
     *
     * Generated from protobuf field <code>string identity = 4;</code>
     * @return string
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Identity of the operator
     *
     * Generated from protobuf field <code>string identity = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setIdentity($var)
    {
        GPBUtil::checkString($var, True);
        $this->identity = $var;

        return $this;
    }

}
