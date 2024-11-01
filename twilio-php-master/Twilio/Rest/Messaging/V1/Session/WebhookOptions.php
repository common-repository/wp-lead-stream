<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Messaging\V1\Session;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class WebhookOptions {
    /**
     * @param string $configurationUrl The absolute url the webhook request should
     *                                 be sent to.
     * @param string $configurationMethod The HTTP method to be used when sending a
     *                                    webhook request.
     * @param string $configurationFilters The list of events, firing webhook event
     *                                     for this Session.
     * @param string $configurationTriggers The list of keywords, firing webhook
     *                                      event for this Session.
     * @param string $configurationFlowSid The studio flow sid, where the webhook
     *                                     should be sent to.
     * @param integer $configurationRetryCount The number of retries in case of
     *                                         webhook request failures.
     * @param integer $configurationReplayAfter The message index for which and
     *                                          it's successors the webhook will be
     *                                          replayed.
     * @param boolean $configurationBufferMessages The flag whether buffering
     *                                             should be applied to messages.
     * @param integer $configurationBufferWindow The period of buffering messages.
     * @return CreateWebhookOptions Options builder
     */
    public static function create($configurationUrl = Values::NONE, $configurationMethod = Values::NONE, $configurationFilters = Values::NONE, $configurationTriggers = Values::NONE, $configurationFlowSid = Values::NONE, $configurationRetryCount = Values::NONE, $configurationReplayAfter = Values::NONE, $configurationBufferMessages = Values::NONE, $configurationBufferWindow = Values::NONE) {
        return new CreateWebhookOptions($configurationUrl, $configurationMethod, $configurationFilters, $configurationTriggers, $configurationFlowSid, $configurationRetryCount, $configurationReplayAfter, $configurationBufferMessages, $configurationBufferWindow);
    }

    /**
     * @param string $configurationUrl The absolute url the webhook request should
     *                                 be sent to.
     * @param string $configurationMethod The HTTP method to be used when sending a
     *                                    webhook request.
     * @param string $configurationFilters The list of events, firing webhook event
     *                                     for this Session.
     * @param string $configurationTriggers The list of keywords, firing webhook
     *                                      event for this Session.
     * @param string $configurationFlowSid The studio flow sid, where the webhook
     *                                     should be sent to.
     * @param integer $configurationRetryCount The number of retries in case of
     *                                         webhook request failures.
     * @param boolean $configurationBufferMessages The flag whether buffering
     *                                             should be applied to messages.
     * @param integer $configurationBufferWindow The period of buffering messages.
     * @return UpdateWebhookOptions Options builder
     */
    public static function update($configurationUrl = Values::NONE, $configurationMethod = Values::NONE, $configurationFilters = Values::NONE, $configurationTriggers = Values::NONE, $configurationFlowSid = Values::NONE, $configurationRetryCount = Values::NONE, $configurationBufferMessages = Values::NONE, $configurationBufferWindow = Values::NONE) {
        return new UpdateWebhookOptions($configurationUrl, $configurationMethod, $configurationFilters, $configurationTriggers, $configurationFlowSid, $configurationRetryCount, $configurationBufferMessages, $configurationBufferWindow);
    }
}

class CreateWebhookOptions extends Options {
    /**
     * @param string $configurationUrl The absolute url the webhook request should
     *                                 be sent to.
     * @param string $configurationMethod The HTTP method to be used when sending a
     *                                    webhook request.
     * @param string $configurationFilters The list of events, firing webhook event
     *                                     for this Session.
     * @param string $configurationTriggers The list of keywords, firing webhook
     *                                      event for this Session.
     * @param string $configurationFlowSid The studio flow sid, where the webhook
     *                                     should be sent to.
     * @param integer $configurationRetryCount The number of retries in case of
     *                                         webhook request failures.
     * @param integer $configurationReplayAfter The message index for which and
     *                                          it's successors the webhook will be
     *                                          replayed.
     * @param boolean $configurationBufferMessages The flag whether buffering
     *                                             should be applied to messages.
     * @param integer $configurationBufferWindow The period of buffering messages.
     */
    public function __construct($configurationUrl = Values::NONE, $configurationMethod = Values::NONE, $configurationFilters = Values::NONE, $configurationTriggers = Values::NONE, $configurationFlowSid = Values::NONE, $configurationRetryCount = Values::NONE, $configurationReplayAfter = Values::NONE, $configurationBufferMessages = Values::NONE, $configurationBufferWindow = Values::NONE) {
        $this->options['configurationUrl'] = $configurationUrl;
        $this->options['configurationMethod'] = $configurationMethod;
        $this->options['configurationFilters'] = $configurationFilters;
        $this->options['configurationTriggers'] = $configurationTriggers;
        $this->options['configurationFlowSid'] = $configurationFlowSid;
        $this->options['configurationRetryCount'] = $configurationRetryCount;
        $this->options['configurationReplayAfter'] = $configurationReplayAfter;
        $this->options['configurationBufferMessages'] = $configurationBufferMessages;
        $this->options['configurationBufferWindow'] = $configurationBufferWindow;
    }

    /**
     * The absolute url the webhook request should be sent to.
     * 
     * @param string $configurationUrl The absolute url the webhook request should
     *                                 be sent to.
     * @return $this Fluent Builder
     */
    public function setConfigurationUrl($configurationUrl) {
        $this->options['configurationUrl'] = $configurationUrl;
        return $this;
    }

    /**
     * The HTTP method to be used when sending a webhook request.
     * 
     * @param string $configurationMethod The HTTP method to be used when sending a
     *                                    webhook request.
     * @return $this Fluent Builder
     */
    public function setConfigurationMethod($configurationMethod) {
        $this->options['configurationMethod'] = $configurationMethod;
        return $this;
    }

    /**
     * The list of events, firing webhook event for this Session.
     * 
     * @param string $configurationFilters The list of events, firing webhook event
     *                                     for this Session.
     * @return $this Fluent Builder
     */
    public function setConfigurationFilters($configurationFilters) {
        $this->options['configurationFilters'] = $configurationFilters;
        return $this;
    }

    /**
     * The list of keywords, firing webhook event for this Session.
     * 
     * @param string $configurationTriggers The list of keywords, firing webhook
     *                                      event for this Session.
     * @return $this Fluent Builder
     */
    public function setConfigurationTriggers($configurationTriggers) {
        $this->options['configurationTriggers'] = $configurationTriggers;
        return $this;
    }

    /**
     * The studio flow sid, where the webhook should be sent to.
     * 
     * @param string $configurationFlowSid The studio flow sid, where the webhook
     *                                     should be sent to.
     * @return $this Fluent Builder
     */
    public function setConfigurationFlowSid($configurationFlowSid) {
        $this->options['configurationFlowSid'] = $configurationFlowSid;
        return $this;
    }

    /**
     * The number of retries in case of webhook request failures. Maximum 3 retries are allowed, the default value is 0.
     * 
     * @param integer $configurationRetryCount The number of retries in case of
     *                                         webhook request failures.
     * @return $this Fluent Builder
     */
    public function setConfigurationRetryCount($configurationRetryCount) {
        $this->options['configurationRetryCount'] = $configurationRetryCount;
        return $this;
    }

    /**
     * The message index for which and it's successors the webhook will be replayed. Not set by default
     * 
     * @param integer $configurationReplayAfter The message index for which and
     *                                          it's successors the webhook will be
     *                                          replayed.
     * @return $this Fluent Builder
     */
    public function setConfigurationReplayAfter($configurationReplayAfter) {
        $this->options['configurationReplayAfter'] = $configurationReplayAfter;
        return $this;
    }

    /**
     * The flag whether buffering should be applied to messages. Not set by default
     * 
     * @param boolean $configurationBufferMessages The flag whether buffering
     *                                             should be applied to messages.
     * @return $this Fluent Builder
     */
    public function setConfigurationBufferMessages($configurationBufferMessages) {
        $this->options['configurationBufferMessages'] = $configurationBufferMessages;
        return $this;
    }

    /**
     * The period of buffering messages. Default is 3000 ms.
     * 
     * @param integer $configurationBufferWindow The period of buffering messages.
     * @return $this Fluent Builder
     */
    public function setConfigurationBufferWindow($configurationBufferWindow) {
        $this->options['configurationBufferWindow'] = $configurationBufferWindow;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Messaging.V1.CreateWebhookOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateWebhookOptions extends Options {
    /**
     * @param string $configurationUrl The absolute url the webhook request should
     *                                 be sent to.
     * @param string $configurationMethod The HTTP method to be used when sending a
     *                                    webhook request.
     * @param string $configurationFilters The list of events, firing webhook event
     *                                     for this Session.
     * @param string $configurationTriggers The list of keywords, firing webhook
     *                                      event for this Session.
     * @param string $configurationFlowSid The studio flow sid, where the webhook
     *                                     should be sent to.
     * @param integer $configurationRetryCount The number of retries in case of
     *                                         webhook request failures.
     * @param boolean $configurationBufferMessages The flag whether buffering
     *                                             should be applied to messages.
     * @param integer $configurationBufferWindow The period of buffering messages.
     */
    public function __construct($configurationUrl = Values::NONE, $configurationMethod = Values::NONE, $configurationFilters = Values::NONE, $configurationTriggers = Values::NONE, $configurationFlowSid = Values::NONE, $configurationRetryCount = Values::NONE, $configurationBufferMessages = Values::NONE, $configurationBufferWindow = Values::NONE) {
        $this->options['configurationUrl'] = $configurationUrl;
        $this->options['configurationMethod'] = $configurationMethod;
        $this->options['configurationFilters'] = $configurationFilters;
        $this->options['configurationTriggers'] = $configurationTriggers;
        $this->options['configurationFlowSid'] = $configurationFlowSid;
        $this->options['configurationRetryCount'] = $configurationRetryCount;
        $this->options['configurationBufferMessages'] = $configurationBufferMessages;
        $this->options['configurationBufferWindow'] = $configurationBufferWindow;
    }

    /**
     * The absolute url the webhook request should be sent to.
     * 
     * @param string $configurationUrl The absolute url the webhook request should
     *                                 be sent to.
     * @return $this Fluent Builder
     */
    public function setConfigurationUrl($configurationUrl) {
        $this->options['configurationUrl'] = $configurationUrl;
        return $this;
    }

    /**
     * The HTTP method to be used when sending a webhook request.
     * 
     * @param string $configurationMethod The HTTP method to be used when sending a
     *                                    webhook request.
     * @return $this Fluent Builder
     */
    public function setConfigurationMethod($configurationMethod) {
        $this->options['configurationMethod'] = $configurationMethod;
        return $this;
    }

    /**
     * The list of events, firing webhook event for this Session.
     * 
     * @param string $configurationFilters The list of events, firing webhook event
     *                                     for this Session.
     * @return $this Fluent Builder
     */
    public function setConfigurationFilters($configurationFilters) {
        $this->options['configurationFilters'] = $configurationFilters;
        return $this;
    }

    /**
     * The list of keywords, firing webhook event for this Session.
     * 
     * @param string $configurationTriggers The list of keywords, firing webhook
     *                                      event for this Session.
     * @return $this Fluent Builder
     */
    public function setConfigurationTriggers($configurationTriggers) {
        $this->options['configurationTriggers'] = $configurationTriggers;
        return $this;
    }

    /**
     * The studio flow sid, where the webhook should be sent to.
     * 
     * @param string $configurationFlowSid The studio flow sid, where the webhook
     *                                     should be sent to.
     * @return $this Fluent Builder
     */
    public function setConfigurationFlowSid($configurationFlowSid) {
        $this->options['configurationFlowSid'] = $configurationFlowSid;
        return $this;
    }

    /**
     * The number of retries in case of webhook request failures. Maximum 3 retries are allowed, the default value is 0.
     * 
     * @param integer $configurationRetryCount The number of retries in case of
     *                                         webhook request failures.
     * @return $this Fluent Builder
     */
    public function setConfigurationRetryCount($configurationRetryCount) {
        $this->options['configurationRetryCount'] = $configurationRetryCount;
        return $this;
    }

    /**
     * The flag whether buffering should be applied to messages. Not set by default
     * 
     * @param boolean $configurationBufferMessages The flag whether buffering
     *                                             should be applied to messages.
     * @return $this Fluent Builder
     */
    public function setConfigurationBufferMessages($configurationBufferMessages) {
        $this->options['configurationBufferMessages'] = $configurationBufferMessages;
        return $this;
    }

    /**
     * The period of buffering messages. Default is 3000 ms.
     * 
     * @param integer $configurationBufferWindow The period of buffering messages.
     * @return $this Fluent Builder
     */
    public function setConfigurationBufferWindow($configurationBufferWindow) {
        $this->options['configurationBufferWindow'] = $configurationBufferWindow;
        return $this;
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Messaging.V1.UpdateWebhookOptions ' . implode(' ', $options) . ']';
    }
}