package com.service;

import com.domain.Authority;
import com.domain.User;
import com.repository.UserRepository;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;

@Service
@Transactional
public class AdminServiceImpl implements AdminService {
    private UserRepository userRepository;
    private PasswordEncoder passwordEncoder;

    public AdminServiceImpl(UserRepository userRepository, PasswordEncoder passwordEncoder) {
        this.userRepository = userRepository;
        this.passwordEncoder = passwordEncoder;
    }

    @Transactional(readOnly = true)
    public List<User> getAllUsers() {
        return userRepository.getAll();
    }

    @Transactional
    public User insert(User user) {
        user.setPassword(passwordEncoder.encode(user.getPassword()));
        return userRepository.create(user);
    }

    @Transactional
    public User update(User user) {
        return userRepository.update(user);
    }

    @Transactional
    public boolean delete(Long id) {
        return userRepository.delete(id);
    }

//    public User test(Long id){
//        User user = userRepository.get(id);
//        user.setPassword(passwordEncoder.toString());
//
//    }

}
