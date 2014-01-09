Weather Web App
as requested by Powershift

Planned and coded by Jasper Smith jasper@sparks.co.uk on 8 and 9 Jan 2014

PLAN:
1) Create basic I/O methods
2) Create methods for querying the api
3) Display 'ugly' version with hyperlinks
4) Style up with CSS
5) UI 'flourishes'
6) Refactor
7) Write readme file and package

COMMENTS:
I've used a straightforward API from http://www.worldweatheronline.com and I've opted for the XML delivery. This makes the querying trivial, though I had to add some error messages for locations that can't be found. A better implementation would offer location choices using the location API to avoid showing the 'wrong' Oxford, or the 'wrong' Paris, (for example).

I've kept the styling minimal and I haven't added any UI flourishes.
