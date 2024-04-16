<?php

if(!defined('ABSPATH')) {
    exit;
}

class GraphqlPage {
    function __construct($args = []) {
        if(!function_exists('register_graphql_object_type') || !function_exists('register_graphql_field')) {
            return;
        }

        if(empty($args)) {
            return;
        }

        $this->args = $args;

        $this->register_object();
    }

    public function register_object() {
        register_graphql_object_type($this->args['slug'], [
            'fields' => $this->args['fields'] ?? [],
        ]);

        register_graphql_field($this->args['root'], $this->args['slug'], [
            'description' => $this->args['description'] ?? '',
            'type' => $this->args['type'] ?? $this->args['slug'],
            'resolve' => $this->args['resolve'] ?? function() { return []; },
        ]);
    }

    public function register_interface($args) {
        register_graphql_interface_type($args['interface'], [
            'fields' => $args['fields'],
        ]);

        register_graphql_interfaces_to_types([$args['interface']], [$this->args['slug']]);
    }
}