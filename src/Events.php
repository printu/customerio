<?php
/**
 * Created by PhpStorm.
 * User: pawel
 * Date: 12.11.2015
 * Time: 13:49
 */

namespace Customerio;

/**
 * Class Events
 * @package Customerio
 *
 * @method array add(array $config = [])
 */
class Events extends BaseClient
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        // Set description_path.
        $config += [
            'description_path' => __DIR__ . '/data/Events.php',
        ];

        // Create the client.
        parent::__construct(
            $config
        );
    }
}