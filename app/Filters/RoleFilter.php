<?php
    namespace App\Filters;

    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use CodeIgniter\Filters\FilterInterface;
    
    class RoleFilter implements FilterInterface
    {
        public function before(RequestInterface $request, $arguments = null)
        {
            $session = session();
            $role = $session->get('role');
    
            // Pastikan role adalah string
            if (is_array($role)) {
                $role = implode(' ', $role);
            }
            $role = trim($role);
    
            // Periksa peran pengguna
            if (!in_array($role, $arguments)) {
                // Jika peran pengguna tidak sesuai, redirect ke halaman yang sesuai
                return redirect()->to('/not-authorized');
            }
        }
    
        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
        {
            // Tidak perlu tindakan setelahnya
        }
    }
    
    
?>