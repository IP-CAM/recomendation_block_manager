<?php
class Cache {
	private $cache;

	public function __construct($driver, $expire = 3600) {
		$class = 'Cache\\' . $driver;

		if (class_exists($class)) {
			$this->cache = new $class($expire);
		} else {
			exit('Error: Could not load cache driver ' . $driver . ' cache!');
		}
	}

	public function get($key) {
		return $this->cache->get($key);
	}

	public function set($key, $value) {
		return $this->cache->set($key, $value);
	}

	public function delete($key) {
		return $this->cache->delete($key);
	}

    public function delete_cache_products() {
        $place_cache_files = glob(DIR_SITE.'system/cache/'.SITE.'/cache.product.*');

        if ($place_cache_files) {
            foreach ($place_cache_files as $cache_file) {
                if (file_exists($cache_file)) {
                    unlink($cache_file);
                }
            }
        }
    }

    public function delete_cache_welldone_modules() {
        $place_cache_files_welldone = glob(DIR_SITE.'system/welldone/data/cache/' . SITE . '/'.'cache-module*');

        if ($place_cache_files_welldone) {
            foreach ($place_cache_files_welldone as $cache_file_welldone) {
                if (file_exists($cache_file_welldone)) {
                    unlink($cache_file_welldone);
                }
            }
        }

    }
}
