<?php

namespace ETNA\Silex\Provider\ChangeRequestProxy;

class ChangeTodos implements \JsonSerializable
{
    /* @var integer $id */
    private $id;

    /* @var \DateTime $created_at */
    private $created_at;

    /* @var \DateTime $updated_at */
    private $updated_at;

    /* @var array $datas */
    private $datas;

    /* @var string $request_type */
    private $request_type;

    /* @var integer $user_request_id */
    private $user_request_id;

    /* @var integer $user_validate_id */
    private $user_validate_id;

    /* @var string $status */
    private $status;

    /* @var array $metas */
    private $metas;

    /* @var array $last_value */
    private $last_value;

    /* @var string $request_comment */
    private $request_comment;

    /* @var string $response_comment */
    private $response_comment;

    public function __construct()
    {
        $this->status = "pending";
    }

    /**
     * Fills itself from array
     *
     * @param  array  $change_request
     *
     * @return self
     */
    public function fromArray(array $change_request)
    {
        foreach ($change_request as $field => $value) {
            if (true === property_exists($this, $field)) {
                $this->{$field} = $value;
            }
        }

        return $this;
    }

    public function toArray()
    {
        return [
            "id"               => $this->getId(),
            "datas"            => $this->getDatas(),
            "request_type"     => $this->getRequestType(),
            "created_at"       => $this->getCreatedAt('c'),
            "updated_at"       => $this->getUpdatedAt('c'),
            "user_request_id"  => $this->getUserRequestId(),
            "user_validate_id" => $this->getUserValidateId(),
            "status"           => $this->getStatus(),
            "metas"            => $this->getMetas(),
            "last_value"       => $this->getLastValue(),
            "request_comment"  => $this->getRequestComment(),
            "response_comment" => $this->getResponseComment()
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

// ------ Getters ------

    /**
     * Gets the value of Id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get create date of change request
     *
     * @return \DateTime|null|string
     */
    public function getCreatedAt($format = null)
    {
        if (null === $format || null === $this->created_at || is_string($this->created_at)) {
            return $this->created_at;
        }

        return $this->created_at->format($format);
    }

    /**
     * Get update date of change request
     *
     * @return \DateTime|null|string
     */
    public function getUpdatedAt($format = null)
    {
        if (null === $format || null === $this->updated_at || is_string($this->updated_at)) {
            return $this->updated_at;
        }

        return $this->updated_at->format($format);
    }

    /**
     * Gets the value of Datas.
     *
     * @return array
     */
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * Gets the value of request type.
     *
     * @return string
     */
    public function getRequestType()
    {
        return $this->request_type;
    }

    /**
     * Gets the value of user request id.
     *
     * @return integer
     */
    public function getUserRequestId()
    {
        return $this->user_request_id;
    }

    /**
     * Gets the value of user validate id.
     *
     * @return integer
     */
    public function getUserValidateId()
    {
        return $this->user_validate_id;
    }

    /**
     * Gets the value of status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Gets the value of metas.
     *
     * @return array
     */
    public function getMetas()
    {
        return $this->metas;
    }

    /**
     * Gets the value of last value.
     *
     * @return array
     */
    public function getLastValue()
    {
        return $this->last_value;
    }

    /**
     * Gets the value of request comment.
     *
     * @return string
     */
    public function getRequestComment()
    {
        return $this->request_comment;
    }

    /**
     * Gets the value of response comment.
     *
     * @return string
     */
    public function getResponseComment()
    {
        return $this->response_comment;
    }

// ------ Setters ------

    /**
     * Sets the value of Datas.
     *
     * @param string $datas
     *
     * @return self
     */
    public function setDatas($datas)
    {
        $this->datas = $datas;

        return $this;
    }

    /**
     * Sets the value of request type.
     *
     * @param string $request_type
     *
     * @return self
     */
    public function setRequestType($request_type)
    {
        $this->request_type = $request_type;

        return $this;
    }

    /**
     * Sets the value of User Request Id.
     *
     * @param integer $user_request_id
     *
     * @return self
     */
    public function setUserRequestId($user_request_id)
    {
        $this->user_request_id = $user_request_id;

        return $this;
    }

    /**
     * Sets the value of user validate id.
     *
     * @param integer $user_validate_id
     *
     * @return self
     */
    public function setUserValidateId($user_validate_id)
    {
        $this->user_validate_id = $user_validate_id;

        return $this;
    }

    /**
     * Sets the value of status.
     *
     * @param string $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Sets the value of metas.
     *
     * @param string $metas
     *
     * @return self
     */
    public function setMetas($metas)
    {
        $this->metas = $metas;

        return $this;
    }

    /**
     * Sets the value of last value.
     *
     * @param string $last_value
     *
     * @return self
     */
    public function setLastValue($last_value)
    {
        $this->last_value = $last_value;

        return $this;
    }

    /**
     * Sets the value of request_comment.
     *
     * @param string $request_comment
     *
     * @return self
     */
    public function setRequestComment($request_comment)
    {
        $this->request_comment = $request_comment;

        return $this;
    }

    /**
     * Sets the value of response_comment.
     *
     * @param string $response_comment
     *
     * @return self
     */
    public function setResponseComment($response_comment)
    {
        $this->response_comment = $response_comment;

        return $this;
    }
}
