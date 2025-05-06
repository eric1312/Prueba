import { createBrowserRouter } from 'react-router-dom';
import MainLayout from '../layouts/MainLayout';
import Home from '../pages/Home';
import About from '../pages/About';

const router = createBrowserRouter([
  {
    path: '/',
    element: <MainLayout />,
    children: [
      { index: true, element: <Home /> },
      { path: 'about', element: <About /> },
    ],
  },
]);

// resources/js/routes/index.js
import Posts from '../pages/Posts';

const postsRouter = createBrowserRouter([
  // ...
  { path: 'posts', element: <Posts /> },
]);

export default postsRouter;