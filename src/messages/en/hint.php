<?php
return [
    'version'                               => 'Version',
    'opcache.enable'                        => 'Determines if OPCache is enabled',
    'opcache.enable_cli'                    => 'Determines if Zend OPCache is enabled for the CLI version of PHP',
    'opcache.use_cwd'                       => 'When this directive is enabled, the OPcache appends the current
    working directory to the script key, thus eliminating possible collisions between files with the same name
    (basename). Disabling the directive improves performance, but may break existing applications',
    'opcache.validate_timestamps'           => 'When disabled, you must reset the OPcache manually or restart
    the webserver for changes to the filesystem to take effect',
    'opcache.validate_permission'           => 'Validate cached file permissions.',
    'opcache.validate_root'                 => 'Prevent name collisions in chroot\'ed environment',
    'opcache.inherited_hack'                => '',
    'opcache.dups_fix'                      => '',
    'opcache.revalidate_path'               => 'Enables or disables file search in include_path optimization',
    'opcache.log_verbosity_level'           => ' All OPcache errors go to the Web server log. By default, only
    fatal errors (level 0) or errors (level 1) are logged. You can also enable warnings (level 2), info messages
    (level 3) or debug messages (level 4)',
    'opcache.memory_consumption'            => 'The OPcache shared memory storage size',
    'opcache.interned_strings_buffer'       => 'The amount of memory for interned strings in Mbytes',
    'opcache.max_accelerated_files'         => 'The maximum number of keys (scripts) in the OPcache hash table.
         Only numbers between 200 and 100000 are allowed',
    'opcache.max_wasted_percentage'         => 'The maximum percentage of "wasted" memory until a restart is scheduled',
    'opcache.consistency_checks'            => 'Check the cache checksum each N requests. The default value of "0"
    means that the checks are disabled.',
    'opcache.force_restart_timeout'         => 'How long to wait (in seconds) for a scheduled restart to begin
     if the cache is not being accessed',
    'opcache.revalidate_freq'               => 'How often (in seconds) to check file timestamps for changes
    to the shared memory storage allocation. ("1" means validate once per second, but only once per request.
    "0" means always validate)',
    'opcache.preferred_memory_model'        => 'Preferred Shared Memory back-end.
    Leave empty and let the system decide.',
    'opcache.blacklist_filename'            => 'The location of the OPcache blacklist file (wildcards allowed).
    Each OPcache blacklist file is a text file that holds the names of files that should not be accelerated.
    The file format is to add each filename to a new line. The filename may be a full path or just a file prefix
    (i.e., /var/www/x  blacklists all the files and directories in /var/www that start with \'x\').
    Line starting with a ; are ignored (comments).',
    'opcache.max_file_size'                 => 'Allows exclusion of large files from being cached. By default all files
 are cached.',
    'opcache.error_log'                     => 'OPcache error_log file name. Empty string assumes "stderr"',
    'opcache.protect_memory'                => 'Protect the shared memory from unexpected writing during script execution.
 Useful for internal debugging only.',
    'opcache.save_comments'                 => 'If disabled, all PHPDoc comments are dropped from the code to reduce the
 size of the optimized code.',
    'opcache.load_comments'=>'',
    'opcache.fast_shutdown'                 => 'If enabled, a fast shutdown sequence is used for the accelerated code',
    'opcache.enable_file_override'          => 'Allow file existence override (file_exists, etc.) performance feature.',
    'opcache.optimization_level'            => 'A bitmask, where each bit enables or disables the appropriate OPcache
 passes',
    'opcache.lockfile_path'                 => '',
    'opcache.file_cache'                    => 'Enables and sets the second level cache directory.
 It should improve performance when SHM memory is full, at server restart or
 SHM reset. The default "" disables file based caching.',
    'opcache.file_cache_only'               => 'Enables or disables opcode caching in shared memory.',
    'opcache.file_cache_consistency_checks' => 'Enables or disables checksum validation when
     script loaded from file cache.',
    'opcache.file_update_protection'=>'',
    'opcache.restrict_api'=>'Allows calling OPcache API functions only from PHP scripts which path is
 started from specified string. The default "" means no restriction',
    'opcache.mmap_base'=>'Mapping base of shared memory segments (for Windows only). All the PHP
 processes have to map shared memory into the same address space. This
 directive allows to manually fix the "Unable to reattach to base address"
 errors.',
    'opcache.huge_code_pages'=>'Enables or disables copying of PHP code (text segment) into HUGE PAGES.
     This should improve performance, but requires appropriate OS configuration.',
    'opcache.file_cache_fallback'=>'Implies opcache.file_cache_only=1 for a certain process that failed to
reattach to the shared memory (for Windows only). Explicitly enabled file cache is required.'
];