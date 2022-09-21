<?php

namespace Customerio\Endpoint;

use GuzzleHttp\Exception\GuzzleException;

class Collections extends Base
{

    /**
     * List collections
     * @see https://customer.io/docs/api/#operation/getCollections
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function search(array $options)
    {
        $path = $this->collectionsPath();

        return $this->client->get($path, $options);
    }

    /**
     * Get collection
     * @see https://customer.io/docs/api/#operation/getCollection
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function get(array $options)
    {
        if (!isset($options['id'])) {
            $this->mockException('Collection id is required!', 'GET');
        } // @codeCoverageIgnore

        $path = $this->collectionsPath($options['id']);
        unset($options['id']);

        return $this->client->get($path, $options);
    }

    /**
     * Create collection
     * @see https://customer.io/docs/api/#operation/addCollection
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function create(array $options)
    {
        if (!isset($options['name'])) {
            $this->mockException('Collection name is required!', 'POST');
        }

        if (!isset($options['data']) && !isset($options['url'])) {
            $this->mockException('Collection data or url is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->collectionsPath();
        $options['endpoint'] = $this->client->getRegion()->apiUri();

        return $this->client->post($path, $options);
    }

    /**
     * Delete a collection
     * @see https://customer.io/docs/api/#operation/deleteCollection
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function delete(array $options)
    {
        if (!isset($options['collection_id'])) {
            $this->mockException('Collection collection_id is required!', 'POST');
        }

        $path = $this->collectionsPath($options['collection_id']);
        unset($options['collection_id']);
        $options['endpoint'] = $this->client->getRegion()->apiUri();

        return $this->client->delete($path, $options);
    }

    /**
     * Update a collection name or data
     * @see https://customer.io/docs/api/#operation/updateCollection
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function update(array $options)
    {
        if (!isset($options['collection_id'])) {
            $this->mockException('Collection collection_id is required!', 'POST');
        }

        $path = $this->collectionsPath($options['collection_id']);
        unset($options['collection_id']);
        $options['endpoint'] = $this->client->getRegion()->apiUri();

        return $this->client->put($path, $options);
    }

    /**
     * Get collection content
     * @see https://customer.io/docs/api/#operation/getCollectionContents
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function content(array $options)
    {
        if (!isset($options['collection_id'])) {
            $this->mockException('Collection collection_id is required!', 'POST');
        }

        $path = $this->collectionsPath($options['collection_id'], ['content']);
        unset($options['collection_id']);
        $options['raw'] = true;

        return $this->client->get($path, $options);
    }

    /**
     * Update collection data
     * @see https://customer.io/docs/api/#operation/updateCollectionContents
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function updateContent(array $options)
    {
        if (!isset($options['collection_id'])) {
            $this->mockException('Collection collection_id is required!', 'POST');
        }

        if (!isset($options['data'])) {
            $this->mockException('Collection data is required!', 'POST');
        } // @codeCoverageIgnore

        $path = $this->collectionsPath($options['collection_id'], ['content']);
        $options = $options['data'];
        $options['endpoint'] = $this->client->getRegion()->apiUri();

        return $this->client->put($path, $options);
    }
}
