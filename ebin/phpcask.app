{application, phpcask,
 [
  {description, ""},
  {vsn, "0.1"},
  {modules, [
             phpcask,
             phpcask_app,
             phpcask_sup
            ]},
  {registered, []},
  {applications, [
                  kernel,
                  stdlib
                 ]},
  {mod, {phpcask_app, []}},
  {env, [
        
        %% Default folder to store bitcask files.
        {dirname, "./priv/data"},
        
        %% Expiration time in seconds for the session data.
        {expiry_secs, 900}

        ]}
 ]}.
