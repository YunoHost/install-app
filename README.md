This small webpage helps users install specific apps by redirecting them to the appropriate page of their YunoHost admin panels.

It is used to create an "Install with YunoHost" badge/link that can be placed on app developers' websites to promote YunoHost. This badge is similar to the badges "deploy to Heroku" etc...

As YunoHost is not a centralized service, such a badge cannot link directly to users' servers. They are thus redirected to this page in which they have to enter the link to their server. This trick is similar to the one used in the "share to diaspora*" badge, which is also a decentralized service.


# Embed the "Install with YunoHost" button

Example for the Roundcube app (official app)

*HTML*

`<a href="https://install-app.yunohost.org/?app=roundcube"><img src="https://install-app.yunohost.org/install-with-yunohost.png" alt="Install Roundcube with YunoHost" /></a>`

*Markdown*

`[![Install Roundcube with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=roundcube)`

[![Install Roundcube with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=roundcube)

Example for the Duniter app (community)

[![Install Duniter with YunoHost](https://github.com/ABLD/install-app/blob/master/rect237-3.png)](https://install-app.yunohost.org/?app=duniter)
