{application, phpcask,
 [
  {description, ""},
  {vsn, "0.1"},
  {modules, [
             phpcask,
             phpcask_app,
             phpcask_sup,
             phpcask_control
            ]},
  {registered, [phpcask]},
  {applications, [
                  kernel,
                  stdlib
                 ]},
  {mod, {phpcask_app, []}},
  {env, [
        
        %% Default folder to store bitcask files.
        {dirname, "./priv/data"}
        ]}
 ]}.
