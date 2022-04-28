package main

import (
	"log"
	"net/http"
	"sync"
)

func NewInMemoryPlayerStore() *InMemoryPlayerStore {
	return &InMemoryPlayerStore{
		map[string]int{},
		sync.RWMutex{},
	}
}

type InMemoryPlayerStore struct {
	store map[string]int
	lock  sync.RWMutex
}

func (i *InMemoryPlayerStore) RecordWin(name string) {
	i.lock.Lock()
	defer i.lock.Unlock()
	i.store[name]++
}

func (i *InMemoryPlayerStore) GetPlayerScore(name string) int {
	i.lock.RLock()
	defer i.lock.RUnlock()
	return i.store[name]
}

func main() {
	server := &PlayerServer{NewInMemoryPlayerStore()}

	if err := http.ListenAndServe(":5000", server); err != nil {
		log.Fatalf("could not listen on port 5000 %v", err)
	}
}
