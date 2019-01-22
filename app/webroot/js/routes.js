routes = [
  // Default route (404 page). MUST BE THE LAST
  {
   path: '/dashboard/:prodoucts',
   url: '/dashboard/products/',
  },
  {
    path: '(.*)',
    url: './pages/404.html',
  },
];
