<?php

namespace Customerio\Endpoint;

use GuzzleHttp\Exception\GuzzleException;

class Objects extends Base
{
    /**
     * List object types
     * @see https://docs.customer.io/integrations/api/app/tag/objects/getobjecttypes
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function types(array $options = [])
    {
        $path = $this->objectTypesPath();

        return $this->client->get($path, $options);
    }

    /**
     * List object types (alias of types)
     * @see https://docs.customer.io/integrations/api/app/tag/objects/getobjecttypes
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function objectTypes(array $options = [])
    {
        return $this->types($options);
    }

    /**
     * Find objects
     * @see https://docs.customer.io/integrations/api/app/tag/objects/getObjectsFilter
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function search(array $options)
    {
        if (!isset($options['object_type_id'])) {
            $this->mockException('Object type id is required!', 'POST');
        } // @codeCoverageIgnore

        if (!isset($options['filter'])) {
            $this->mockException('Filter is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->objectsPath();
        $options['endpoint'] = $this->client->getRegion()->apiUri();

        return $this->client->post($path, $options);
    }

    /**
     * Find objects (alias of search)
     * @see https://docs.customer.io/integrations/api/app/tag/objects/getObjectsFilter
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function find(array $options)
    {
        return $this->search($options);
    }

    /**
     * Get Object Relationships
     * @see https://docs.customer.io/integrations/api/app/tag/objects/getObjectRelationships
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function relationships(array $options)
    {
        if (!isset($options['object_type_id'])) {
            $this->mockException('Object type id is required!', 'GET');
        } // @codeCoverageIgnore

        if (!isset($options['object_id'])) {
            $this->mockException('Object id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->objectsPath($options['object_type_id'], $options['object_id'], ['relationships']);
        unset($options['object_type_id']);
        unset($options['object_id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get Object Attributes
     * @see https://docs.customer.io/integrations/api/app/tag/objects/getobjectattributes
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function attributes(array $options)
    {
        if (!isset($options['object_type_id'])) {
            $this->mockException('Object type id is required!', 'GET');
        } // @codeCoverageIgnore

        if (!isset($options['object_id'])) {
            $this->mockException('Object id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->objectsPath($options['object_type_id'], $options['object_id'], ['attributes']);
        unset($options['object_type_id']);
        unset($options['object_id']);

        return $this->client->get($path, $options);
    }

    /**
     * Get Object Attributes (alias of attributes)
     * @see https://docs.customer.io/integrations/api/app/tag/objects/getobjectattributes
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function get(array $options)
    {
        return $this->attributes($options);
    }
}
