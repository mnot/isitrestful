#!/usr/bin/env python

from cgi import parse_qs
from flup.server.fcgi import WSGIServer
import hashlib
import pystache
from random import choice
import re
from urllib.parse import urlsplit, urlunsplit
from uri_validate import absolute_URI

charset="utf-8"
tmpl = open('isitrestful.mu').read()
phrases = open('phrases.txt').readlines()
white_sites = [l.strip() for l in open('white.txt').readlines()]
black_sites = [l.strip() for l in open('black.txt').readlines()]

def app(environ, start_response):
    d = parse_qs(environ['QUERY_STRING'])
    url = d.get('url', [''])[0].decode(charset, 'replace')

    if not url:
        phrase = None
    elif not re.match("^%s$" % absolute_URI, url, re.VERBOSE):
        phrase = "A real URL, please."
    else:
        scheme, authority, path, query, frag = urlsplit(url)
        scheme = scheme.lower()
        authority = authority.lower()
        url = urlunsplit((scheme, authority, path, "", ""))
        if scheme in ['urn']:
            phrase = "How the hell do you expect me to know?"
        elif scheme in ['ftp', 'gopher']:
            phrase = "Welcome to 1992."
        elif scheme in ['javascript']:
            phrase = "Roy says 'go fuck yourself.'"
        elif scheme in ['about']:
            phrase = "Hi Alexey."
        elif not scheme in ['http', 'https']:
            phrase = "I don't know nothin' about no %s URLs..." % scheme
        elif authority in white_sites:
            phrase = "But of course."
        elif authority in black_sites:
            phrase = "They think it is, but it isn't."
        else:
            phrase = phrases[
                int(hashlib.md5(url).hexdigest(), 16) % len(phrases)
            ]
#        phrase = choice(phrases)

    start_response('200 OK', [
        ('Content-Type', 'text/html'),
        ('Cache-Control', 'max-age=3600')
    ])
    yield str(pystache.render(tmpl, {
        'phrase': phrase,
        'url': url
        }))


WSGIServer(app).run()
