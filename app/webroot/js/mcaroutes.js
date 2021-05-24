routes = [
  // Default route (404 page). MUST BE THE LAST
  {
   path: '/home/',
   url: '/mca/index/',
  },
  {
   path: '/pdfs/',
   url: '/mca/pdfs/',
  },  {
    path: '(.*)',
    url: './pages/404.html',
  },
];
