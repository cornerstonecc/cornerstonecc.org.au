# Documentation for cornerstonecc.org.au

This repository contains the website code used for
[cornerstonecc.org.au][ccc-website], and includes a lightly modified child
theme based off Wordpress' official [TwentyTwenty] theme
([source code][2020-src]).

[ccc-website]: https://www.cornerstonecc.org.au/
[TwentyTwenty]: https://wordpress.com/theme/twentytwenty
[2020-src]: https://core.trac.wordpress.org/browser/trunk/src/wp-content/themes/twentytwenty?rev=

## Quickstart

To [deploy to production](#production-theme-deployment): commit your code
within the `./deploy/` folder and push to the main branch 🎉

To [test your theme/plugin locally](#development-local-testing): create the
necessary secrets in `./secrets/` and run `docker-compose up` from the root
directory 🎉

```
.
├── .github
│   └── workflows         # CI/CD SCRIPTS
│       └── deploy.yml
├── deploy                # PRODUCTION CODE:
│   └── wp-content        #   Everything within develop/ gets uploaded to 
│       ├── mu-plugins    #   sftp://sftp.wp.com/htdocs/ on each commit to
│       ├── plugins       #   the main branch (via GitHub Actions).
│       ├── themes
│       │   └── twentytwenty-child
│       │       └── ...
│       └── ...
├── .gitignore
├── docker-compose.yaml   # Local testing. See "Development: local testing" below.
└── README.md             # Main project documentation (this file)
```

--------

## Production: theme deployment

**Theme updates are automatically deployed when commits are pushed to the
master branch of this repository.**

Commits to the main branch will trigger a _GitHub Action_ that will upload the
source files to Wordpress.com. Specifically, the contents of the local
`deploy/` folder will get uploaded to the remote `htdocs/` folder within
Cornerstone's Wordpress.com account.

Wordpress SFTP credentials can be found in the
[Cornerstone Wordpress admin][sftp-creds]. _Note: passwords can't be read, only
reset._ These secrets are saved in the GitHub admin (not the repository) so
they can be made available to the deployment process.

If you need to reset the SFTP password in Wordpress, don't forget to update
them in GitHub at "cornerstonecc.org.au repository > Settings > Secrets"
([direct link][gh-secrets]).

[sftp-creds]: https://wordpress.com/hosting-config/cornerstonegungahlin.wpcomstaging.com
[gh-secrets]: https://github.com/cornerstonecc/cornerstonecc.org.au/settings/secrets/actions

More information about the SFTP Github Action and its various settings can be
found [here][sftp-gh-action].

Wordpress.com documentation on deploying via GitHub Actions can be found
[here][wp-gh-action].

[sftp-gh-action]: https://github.com/Automattic/FTP-Deploy-Action/blob/3.0.1/README.md#settings
[wp-gh-action]: https://wordpress.com/support/deploy-from-github-workflow/


## Development: local testing

Themes and plugins can be tested locally via the included `docker-compose.yaml`
file.

1. Ensure you have Docker running
2. Create the necessary [secrets][dc-secrets] files. Currently, you need the
   following for database initialisation (can be whatever you like):
    - `./secrets/db_password.txt`
    - `./secrets/db_root_password.txt`
3. From the root directory run `docker-compose up` and view your theme at
   [http://localhost:8000/]()

_[Documentation for `docker-compose`](https://docs.docker.com/compose/reference/overview/)._ 

[dc-secrets]: https://docs.docker.com/compose/compose-file/#secrets

--------

## Custom integrations

### Youtube API key

Used by the Wordpress plugin: [Embed Plus for YouTube][]

[Embed Plus for YouTube]: https://wordpress.org/plugins/youtube-embed-plus/

Currently the plugin uses an API key created with a Malalta account. This can
be easily updated to one from a Cornerstone account via the following process.

_[Video walk through.](https://www.youtube.com/watch?v=VqML5F8hcRQ)_

To create a Cornerstone YouTube Data API key (as of November 2020):

1. Go to the [Google Cloud Console][]
2. If you already have a project created, optionally create a new project.
    - If you _don't_ have any projects in your account, you'll be prompted to
      create one when activating the API.
3. Select "YouTube Data API v3" and click the "Enable" button.
4. With the API enabled in your project, click the "Overview" heading on the
   left, and select the "Create credentials" button
5. Go through the credentials wizard with the follow selections:
    - **Which API are you using?** YouTube Data API v3
    - **Where will you be calling the API from?** Web server (e.g. node.js,
      Tomcat)
    - **What data will you be accessing?** Public data
    - ...then click the "What credentials do I need?" button
6. Restricting the key is recommended. To do so click "Restrict key" and enter
   the following details:
   - **Name:** Anything you like... for example: "YouTube API Key for
     EmbedPlus"
   - **Application restrictions:** HTTP referrers (web sites)
   - **Website restrictions:**
       - `*.cornerstonecc.org.au/*`
       - `*.cornerstonegungahlin.wpcomstaging.com/*`
       - `*.wordpress.com/*`
   - **API restrictions:** "Restrict key", and then select "YouTube Data API
     v3"
   - ...then click "Save"
7. If taken back to the _Add credentials_ screen, click Cancel
8. With the "Credentials" menu selected on the left, find your new API key
   under the "API Keys" section and click the copy icon in the "Key" collum.
   
Finally, with your new key copied return the _Embed Plus for Youtube_ (also
called "YouTube Free") plugin in Wordpress and paste your new key under on the
"API Key" page, then click Save.

[Google Cloud Console]: https://console.cloud.google.com/apis/library
