<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute field must be accepted.',
    'accepted_if' =>
    'The :attribute field must be accepted when :other is :value.',
    'active_url' => 'The :attribute field must be a valid URL.',
    'after' => 'The :attribute field must be a date after :date.',
    'after_or_equal' =>
    'The :attribute field must be a date after or equal to :date.',
    'alpha' => 'The :attribute field must only contain letters.',
    'alpha_dash' =>
    'The :attribute field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' =>
    'The :attribute field must only contain letters and numbers.',
    'array' => 'The :attribute field must be an array.',
    'ascii' =>
    'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'The :attribute field must be a date before :date.',
    'before_or_equal' =>
    'The :attribute field must be a date before or equal to :date.',
    'between' => [
        'array' =>
        'The :attribute field must have between :min and :max items.',
        'file' =>
        'The :attribute field must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute field must be between :min and :max.',
        'string' =>
        'The :attribute field must be between :min and :max characters.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute field confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute field must be a valid date.',
    'date_equals' => 'The :attribute field must be a date equal to :date.',
    'date_format' => 'The :attribute field must match the format :format.',
    'decimal' => 'The :attribute field must have :decimal decimal places.',
    'declined' => 'The :attribute field must be declined.',
    'declined_if' =>
    'The :attribute field must be declined when :other is :value.',
    'different' => 'The :attribute field and :other must be different.',
    'digits' => 'The :attribute field must be :digits digits.',
    'digits_between' =>
    'The :attribute field must be between :min and :max digits.',
    'dimensions' => 'The :attribute field has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' =>
    'The :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' =>
    'The :attribute field must not start with one of the following: :values.',
    'email' => 'The :attribute field must be a valid email address.',
    'ends_with' =>
    'The :attribute field must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute field must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'array' => 'The :attribute field must have more than :value items.',
        'file' => 'The :attribute field must be greater than :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than :value.',
        'string' =>
        'The :attribute field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute field must have :value items or more.',
        'file' =>
        'The :attribute field must be greater than or equal to :value kilobytes.',
        'numeric' =>
        'The :attribute field must be greater than or equal to :value.',
        'string' =>
        'The :attribute field must be greater than or equal to :value characters.',
    ],
    'image' => 'The :attribute field must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field must exist in :other.',
    'integer' => 'The :attribute field must be an integer.',
    'ip' => 'The :attribute field must be a valid IP address.',
    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
    'json' => 'The :attribute field must be a valid JSON string.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'lt' => [
        'array' => 'The :attribute field must have less than :value items.',
        'file' => 'The :attribute field must be less than :value kilobytes.',
        'numeric' => 'The :attribute field must be less than :value.',
        'string' => 'The :attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute field must not have more than :value items.',
        'file' =>
        'The :attribute field must be less than or equal to :value kilobytes.',
        'numeric' =>
        'The :attribute field must be less than or equal to :value.',
        'string' =>
        'The :attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'The :attribute field must not have more than :max items.',
        'file' =>
        'The :attribute field must not be greater than :max kilobytes.',
        'numeric' => 'The :attribute field must not be greater than :max.',
        'string' =>
        'The :attribute field must not be greater than :max characters.',
    ],
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    'mimes' => 'The :attribute field must be a file of type: :values.',
    'mimetypes' => 'The :attribute field must be a file of type: :values.',
    'min' => [
        'array' => 'The :attribute field must have at least :min items.',
        'file' => 'The :attribute field must be at least :min kilobytes.',
        'numeric' => 'The :attribute field must be at least :min.',
        'string' => 'The :attribute field must be at least :min characters.',
    ],
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' =>
    'The :attribute field must be missing when :other is :value.',
    'missing_unless' =>
    'The :attribute field must be missing unless :other is :value.',
    'missing_with' =>
    'The :attribute field must be missing when :values is present.',
    'missing_with_all' =>
    'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute field format is invalid.',
    'numeric' => 'The :attribute field must be a number.',
    'password' => [
        'letters' => 'The :attribute field must contain at least one letter.',
        'mixed' =>
        'The :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute field must contain at least one number.',
        'symbols' => 'The :attribute field must contain at least one symbol.',
        'uncompromised' =>
        'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' =>
    'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' =>
    'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute field format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' =>
    'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' =>
    'The :attribute field is required when :other is accepted.',
    'required_unless' =>
    'The :attribute field is required unless :other is in :values.',
    'required_with' =>
    'The :attribute field is required when :values is present.',
    'required_with_all' =>
    'The :attribute field is required when :values are present.',
    'required_without' =>
    'The :attribute field is required when :values is not present.',
    'required_without_all' =>
    'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute field must match :other.',
    'size' => [
        'array' => 'The :attribute field must contain :size items.',
        'file' => 'The :attribute field must be :size kilobytes.',
        'numeric' => 'The :attribute field must be :size.',
        'string' => 'The :attribute field must be :size characters.',
    ],
    'starts_with' =>
    'The :attribute field must start with one of the following: :values.',
    'string' => 'The :attribute field must be a string.',
    'timezone' => 'The :attribute field must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'uppercase' => 'The :attribute field must be uppercase.',
    'url' => 'The :attribute field must be a valid URL.',
    'ulid' => 'The :attribute field must be a valid ULID.',
    'uuid' => 'The :attribute field must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'serviceCategory' => [
            'store' => [
                'title' => 'Title',
                'parent_id' => 'Parent Category',
                'slug' => 'Slug',
                'description' => 'Description',
                'active' => 'Active',
            ],
        ],
        'area' => [
            'store' => [
                'ward_id' => 'Ward id',
                'name' => 'Name',
                'address1' => 'Address number one',
                'zip_no' => 'Zip-no',
                'status' => 'Status',
            ],
        ],
        'serviceArticle' => [
            'store' => [
                'service_category_id' => 'Parent Service Category',
                'service_id' => 'Parent Service',
                'title' => 'Title',
                'slug' => 'Slug',
                'content' => 'Content',
                'description' => 'Description',
                'status' => 'Status',
            ],
        ],
        'name' => 'Name',
        'description' => 'Description',
        'active' => 'Active',
        'icon' => 'Icon',
        'price' => 'Price',
        'garbage_type_id' => 'ID garbage type',
        'code' => 'Code',
        'missendReport' => [
            'store' => [
                'garbage_type_id' => 'Garbage type',
                'first_name' => 'First name',
                'last_name' => 'Last_name',
                'email_address' => 'Email address',
                'account' => 'Account',
                'description' => 'Description',
                'service_address' => 'Service address',
                'phone_number' => 'Phone number',
            ],
        ],
        'damagedMissingReport' => [
            'store' => [
                'container_garbage_type_id' => 'Container garbage type',
                'type' => 'Type',
                'report_id' => 'Report',
            ],
        ],
        'reportApp' => [
            'email' => 'Email',
            'comment' => 'Comment',
        ],
        'service' => [
            'store' => [
                'title' => 'Title',
                'slug' => 'Slug',
                'image_url' => 'Image address',
                'content' => 'Content',
                'description' => 'Description',
                'active' => 'Active',
            ],
        ],
        'date_start_at' => 'Date start',
        'date_end_at' => 'Date end',
        'time_start_at' => 'Time start',
        'area_id' => 'Area',
        'schedule_day' => 'Schedule day',
        'garbage_type' => 'Garbage type',
        'type' => 'Type',
        'q' => 'Query field',
        'is_repeat' => 'IsRepeat',
        'day_of_week' => 'Day of Week',
        'service_garbage_type' => 'Service garbage type',
        'title' => 'Title',
        'email' => 'Email',
        'address' => 'Address',
        'container_garbage_types.*.bin_size' => "Bin size",
        'container_garbage_types.*.image' => "Image",
        '*.bin_size' => 'Bin size',
        '*.image' => 'Image',
        'containerGarbage' => [
            'store' => [
                'garbage_type_id' => 'Garbage Type',
                '*.bin_size' => 'Bin size',
                '*.image' => 'Image',
                'active' => 'Active',
            ]
        ]
    ],
    'serviceCategory' => [
        'store' => [
            'required' => ':attribute is required!',
            'max' => ':attribute cannot exceed :max characters!',
            'exists' => 'The selected :attribute is invalid.',
            'boolean' => 'The :attribute field must be 1(true) or 0(false)',
            'unique' => ':attribute already exists!',
        ],
    ],
    'area' => [
        'store' => [
            'required' => ':attribute is required!',
            'max' => ':attribute cannot exceed 8 characters!',
            'exists' => 'The selected :attribute is invalid.',
            'boolean' => 'The :attribute field must be 1(true) or 0(false)',
            'integer' => ':attribute is a number!',
            'min' => ":attribute cannot be less than 7 characters!",
            'numeric' => 'The :attribute field must be a number.',
        ]
    ],
    'serviceGarbage' => [
        'required' => ':attribute is required!',
        'max' => ':attribute cannot exceed :max characters!',
        'integer' => ':attribute is a number!',
        'between' =>
        ':attribute is only accept :min(no active) and :max(active)!',
        'numeric' => ':attribute is a number!',
        'not_in' => ':attribute must not begin with the number (0)!',
        'exists' => ':attribute not an existing ID!',
        'distinct' => 'Service garbage type field contain duplicate values!',
        'unique' => ':attribute already exists!',
    ],
    'garbageType' => [
        'required' => ':attribute is required!',
        'max' => ':attribute cannot exceed :max characters!',
        'unique' => ':attribute already exists!',
        'integer' => ':attribute is a number!',
        'between' =>
        ':attribute is only accept :min(no active) and :max(active)!',
        'image' => ':attribute invalid!',
        'maxIcon' => ':attribute size must be less than :max kb!',
        'mimes' => ':attribute must be (jpeg, png, jpg, gif)!',
    ],
    'language' => [
        'required' => ':attribute is required!',
        'max' => ':attribute cannot exceed :max characters!',
        'unique' => ':attribute already exists!',
    ],
    'missendReport' => [
        'store' => [
            'required' => ':attribute is required!',
            'max' => ':attribute cannot exceed :max characters!',
            'exists' => 'The selected :attribute is invalid.',
            'email' => 'The :attribute field must be an email address.',
        ],
    ],
    'damagedMissingReport' => [
        'store' => [
            'required' => ':attribute is required!',
            'exists' => 'The selected :attribute is invalid.',
        ],
    ],
    'reportApp' => [
        'store' => [
            'required' => ':attribute is required!',
            'email' => 'The :attribute field must be an email address.',
        ],
    ],
    'service' => [
        'store' => [
            'required' => ':attribute is required!',
            'max' => ':attribute cannot exceed :max characters!',
            'unique' => ':attribute already exists!',
            'image' => 'The image URL must be a valid image format.',
            'mimes' => 'The image URL must have a format of jpeg, jpg, png, gif.',
            'boolean' => 'The :attribute field must be 1(true) or 0(false).',
        ],
    ],
    'serviceArticle' => [
        'store' => [
            'exists' => 'The selected :attribute is invalid.',
            'required' => ':attribute is required!',
            'max' => ':attribute cannot exceed :max characters!',
            'unique' => ':attribute already exists!',
            'boolean' => 'The :attribute field must be 1(true) or 0(false).',
        ],
    ],
    'login' => [
        'required' => ':attribute is required!',
        'max' => ':attribute cannot exceed :max characters!',
        'email' => ':attribute is Email!',
    ],
    'schedule' => [
        'required' => ':attribute is required!',
        'date' => ':attribute invalid date!',
        'after' => 'The end date must be greater than the start date!',
        'after_time' => 'The end time must be greater than the start time!',
        'date_format' => 'The date format must be dd/MM/yyyy',
        'integer' => ':attribute is a number!',
        'between' =>
        ':attribute is only accept :min(no active) and :max(active)!',
        'day_of_week_between' =>
        ':attribute is only accept :min(monday) and :max(sunday)!',
        'is_repeat_between' =>
        ':attribute is only accept :min(no repeat) and :max(repeat)!',
        'exists' => ':attribute not an existing ID!',
        'distinct' => 'The garbage type field contains duplicate values!',
    ],
    'search' => [
        'required' => ':attribute is required!',
    ],
    'page' => [
        'required' => ":attribute is required!",
        'max' => ":attribute cannot exceed :max characters!",
        'min' => ":attribute cannot be less than :min characters!",
        'integer' => ":attribute is a number!",
        'between' => ":attribute is only accept 1:None, 2:terms of service,3:privacy policy",
    ],
    'containerGarbage' => [
        'store' => [
            'required' => ":attribute is required!",
            'exists' => ":attribute not an existing ID!",
            'image' => 'The image must be a valid image format.',
            'mimes' => 'The image must have a format of jpeg, jpg, png, gif.',
            'boolean' => 'The :attribute field must be active or inactive.',
            'unique' => 'The combination of (garbage type) and (bin size) already exists.',
            'integer' => ":attribute is a number!",
            'max' => "The :attribute field must be :max kilobytes.",
        ]
    ],
    'reportPlace' => [
        'required' => ':attribute is required!',
        'email' => ':attribute field must be an email address!',
    ],
];
